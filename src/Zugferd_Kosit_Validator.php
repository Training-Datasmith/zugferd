<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use Dom_Document;
use Domx_Path;
use horstoeko\stringmanagement\File_Utils;
use horstoeko\stringmanagement\Path_Utils;
use horstoeko\stringmanagement\String_Utils;
use Symfony\Component\Process\Executable_Finder;
use Symfony\Component\Process\Process;
use Throwable;
use Zip_Archive;
/**
 * Class representing the validator against Schematron (Kosit) for documents.
 * This class requires a JAVA running setup
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Kosit_Validator
{
    /**
     * The invoice document reference
     *
     * @var ZugferdDocument|string|null
     */
    private $document;
    /**
     * Internal message bag
     *
     * @var array
     */
    private $message_bag = [];
    /**
     * Base directory (download)
     *
     * @var string
     */
    private $base_directory;
    /**
     * Kosit Validator download url
     *
     * @var string
     */
    private $validator_download_url = 'https://github.com/itplr-kosit/validator/releases/download/v1.5.0/validator-1.5.0-distribution.zip';
    /**
     * Kosit Validator scenarios download url
     *
     * @var string
     */
    private $validator_scenario_download_url = 'https://github.com/itplr-kosit/validator-configuration-xrechnung/releases/download/release-2025-03-21/validator-configuration-xrechnung_3.0.2_2025-03-21.zip';
    /**
     * The filename of the validation application zip archive
     *
     * @var string $validatorAppZipFilename
     */
    private $validator_app_zip_filename = 'validator.zip';
    /**
     * The filename of the validation scenario zip archive
     *
     * @var string $validatorScenarioZipFilename
     */
    private $validator_scenario_zip_filename = 'validator-configuration.zip';
    /**
     * The java application filename
     *
     * @var string $validatorAppJarFilename
     */
    private $validator_app_jar_filename = 'validationtool-1.5.0-standalone.jar';
    /**
     * The java application scenario filename
     *
     * @var string
     */
    private $validator_app_scenario_filename = 'scenarios.xml';
    /**
     * The temporary filename which contains the xml data to validate
     *
     * @var string
     */
    private $file_to_validate_filename = '';
    /**
     * Internal flag which indicates that the cleanup of the base directory is disables
     *
     * @var boolean
     */
    private $cleanup_base_directory_is_disabled = false;
    /**
     * Use remote validation (JAVA application is running in daemon mode on a remote host)
     *
     * @var boolean
     */
    private $remote_mode_enabled = false;
    /**
     * The remote hostname or -ip
     *
     * @var string
     */
    private $remote_mode_host = '';
    /**
     * The remote host port
     *
     * @var integer
     */
    private $remote_mode_port = 0;
    /**
     * Message Type "Internal Error"
     */
    protected const MSG_TYPE_INTERNALERROR = 'internalerror';
    /**
     * Message Type "Validation Error"
     */
    protected const MSG_TYPE_VALIDATIONERROR = 'validationerror';
    /**
     * Message Type "Validation Warning"
     */
    protected const MSG_TYPE_VALIDATIONWARNING = 'validationwarning';
    /**
     * Message Type "Validation info"
     */
    protected const MSG_TYPE_VALIDATIONINFORMATION = 'validationinformation';
    /**
     * Message Type "Process Output"
     */
    protected const MSG_TYPE_PROCESSOUTPUT = 'processoutput';
    /**
     * Create a KositValidator-Instance by a given content string
     */
    public static function from_string(string $document): Zugferd_Kosit_Validator
    {
        return new Zugferd_Kosit_Validator($document);
    }
    /**
     * Create a KositValidator-Instance by a given ZugferdDocument (ZugferdDocumentReader, ZugferdDocumentBuilder)
     */
    public static function from_zugferd_document(Zugferd_Document $zugferd_document): Zugferd_Kosit_Validator
    {
        return new Zugferd_Kosit_Validator($zugferd_document);
    }
    /**
     * Constructor
     *
     * @param ZugferdDocument|string|null $document
     */
    public function __construct($document = null)
    {
        $this->base_directory = sys_get_temp_dir();
        $this->set_document($document);
    }
    /**
     * Set the ZugferdDocument instance to validate
     *
     * @param  ZugferdDocument|string $document
     */
    public function set_document($document): Zugferd_Kosit_Validator
    {
        if (!is_string($document) && !$document instanceof Zugferd_Document) {
            return $this;
        }
        $this->document = $document;
        return $this;
    }
    /**
     * Setup the base directory. In the base directory all files will be downloaded
     * and created
     */
    public function set_base_directory(string $new_base_directory): Zugferd_Kosit_Validator
    {
        if (is_dir($new_base_directory)) {
            $this->base_directory = $new_base_directory;
        }
        return $this;
    }
    /**
     * Setup the KOSIT validator application download url
     */
    public function set_validator_download_url(string $new_validator_download_url): Zugferd_Kosit_Validator
    {
        if (filter_var($new_validator_download_url, FILTER_VALIDATE_URL) !== false) {
            $this->validator_download_url = $new_validator_download_url;
        }
        return $this;
    }
    /**
     * Setup the KOSIT validator scenario download url
     */
    public function set_validator_scenario_download_url(string $new_validator_scenario_download_url): Zugferd_Kosit_Validator
    {
        if (filter_var($new_validator_scenario_download_url, FILTER_VALIDATE_URL) !== false) {
            $this->validator_scenario_download_url = $new_validator_scenario_download_url;
        }
        return $this;
    }
    /**
     * Set the filename of the ZIP file which contains the validation application
     */
    public function set_validator_app_zip_filename(string $new_validator_app_zip_filename): Zugferd_Kosit_Validator
    {
        $this->validator_app_zip_filename = $new_validator_app_zip_filename;
        return $this;
    }
    /**
     * Set the filename of the ZIP file which contains the validation scenarios
     */
    public function set_validator_scenario_zip_filename(string $new_validator_scenario_zip_filename): Zugferd_Kosit_Validator
    {
        $this->validator_scenario_zip_filename = $new_validator_scenario_zip_filename;
        return $this;
    }
    /**
     * Set the filename of the applications JAR
     */
    public function set_validator_app_jar_filename(string $new_validator_app_jar_filename): Zugferd_Kosit_Validator
    {
        $this->validator_app_jar_filename = $new_validator_app_jar_filename;
        return $this;
    }
    /**
     * Set the filename of the application scenario file
     */
    public function set_validator_app_scenario_filename(string $new_validator_app_scenario_filename): Zugferd_Kosit_Validator
    {
        $this->validator_app_scenario_filename = $new_validator_app_scenario_filename;
        return $this;
    }
    /**
     * Disable cleanup base directory
     */
    public function disable_cleanup(): Zugferd_Kosit_Validator
    {
        $this->cleanup_base_directory_is_disabled = true;
        return $this;
    }
    /**
     * Enable cleanup base directory
     */
    public function enable_cleanup(): Zugferd_Kosit_Validator
    {
        $this->cleanup_base_directory_is_disabled = false;
        return $this;
    }
    /**
     * Disable the usage of a remote host validation
     */
    public function disable_remote_mode(): Zugferd_Kosit_Validator
    {
        $this->remote_mode_enabled = false;
        return $this;
    }
    /**
     * Enable the usage of a remote host validation
     */
    public function enable_remote_mode(): Zugferd_Kosit_Validator
    {
        $this->remote_mode_enabled = true;
        return $this;
    }
    /**
     * Set the hostname or the ip of the remote host where the validation application
     * is running in daemon mode
     */
    public function set_remote_mode_host(string $remote_mode_host): Zugferd_Kosit_Validator
    {
        if (String_Utils::string_is_null_or_empty($remote_mode_host)) {
            return $this;
        }
        $this->remote_mode_host = $remote_mode_host;
        return $this;
    }
    /**
     * Set the port of the remote host where the validation application
     * is running in daemon mode
     */
    public function set_remote_mode_port(int $remote_mode_port): Zugferd_Kosit_Validator
    {
        if ($remote_mode_port <= 0) {
            return $this;
        }
        $this->remote_mode_port = $remote_mode_port;
        return $this;
    }
    /**
     * Returns the full remote mode URL
     */
    public function get_remote_mode_url(): string
    {
        return sprintf('http://%s:%s', $this->remote_mode_host, $this->remote_mode_port);
    }
    /**
     * Perform validation
     */
    public function validate(): Zugferd_Kosit_Validator
    {
        $this->clear_message_bag();
        if ($this->check_requirements() === false) {
            return $this;
        }
        if ($this->download_required_files() === false) {
            $this->cleanup_base_directory();
            return $this;
        }
        if ($this->unpack_required_files() === false) {
            $this->cleanup_base_directory();
            return $this;
        }
        $this->perform_validation();
        $this->cleanup_base_directory();
        return $this;
    }
    /**
     * Internal get the content of the document
     */
    private function get_document_content(): string
    {
        if (is_string($this->document)) {
            return $this->document;
        }
        return $this->document->serialize_as_xml();
    }
    /**
     * Internal get (and create) the directory for downloads and file creation
     */
    private function resolve_base_directory(): string
    {
        $base_directory_suffix = md5($this->validator_download_url . $this->validator_scenario_download_url);
        $base_directory = Path_Utils::combine_path_with_path($this->base_directory, sprintf('kositvalidator-%s', $base_directory_suffix));
        if (!is_dir($base_directory)) {
            @mkdir($base_directory);
        }
        return $base_directory;
    }
    /**
     * Get the full filename of the archive to download which contains the Java validation application
     */
    private function resolve_app_zip_filename(): string
    {
        return Path_Utils::combine_path_with_file($this->resolve_base_directory(), $this->validator_app_zip_filename);
    }
    /**
     * Get the full filename of the archive to download which contains the Java validation application scenarios
     */
    private function resolve_scenatio_zip_filename(): string
    {
        return Path_Utils::combine_path_with_file($this->resolve_base_directory(), $this->validator_scenario_zip_filename);
    }
    /**
     * Get the full filename of the validator application jar file
     */
    private function resolve_app_jar_filename(): string
    {
        return Path_Utils::combine_all_paths($this->resolve_base_directory(), $this->validator_app_jar_filename);
    }
    /**
     * Get the full filename of the validator application scenario file
     */
    private function resolve_app_scenario_filename(): string
    {
        return Path_Utils::combine_path_with_file($this->resolve_base_directory(), $this->validator_app_scenario_filename);
    }
    /**
     * Reset the internal filename where data of the PDF to validate are stored
     */
    private function reset_file_to_validate_filename(): void
    {
        $this->file_to_validate_filename = '';
    }
    /**
     * Get the full filename which contains the PDF to validate
     */
    private function resolve_file_to_validate_filename(): string
    {
        if (String_Utils::string_is_null_or_empty($this->file_to_validate_filename)) {
            $this->file_to_validate_filename = Path_Utils::combine_path_with_file($this->resolve_base_directory(), sprintf('filetovalidate-%s-%s.xml', uniqid(), uniqid()));
        }
        return $this->file_to_validate_filename;
    }
    /**
     * Clear the internal error bag
     */
    private function clear_message_bag(): void
    {
        $this->message_bag = [];
    }
    /**
     * Add message to error bag
     *
     * @param  string|Throwable $error
     */
    private function add_to_message_bag($error, string $message_type = ''): void
    {
        $message_type = String_Utils::string_is_null_or_empty($message_type) ? static::MSG_TYPE_INTERNALERROR : $message_type;
        if (is_string($error)) {
            $this->message_bag[] = ['type' => $message_type, 'message' => $error];
        } elseif ($error instanceof Throwable) {
            $this->message_bag[] = ['type' => $message_type, 'message' => $error->get_message()];
        }
    }
    /**
     * Get messages from messagebag filtered by message type
     */
    private function get_message_bag_filtered(string $message_type): array
    {
        return array_map(function (array $data) {
            return $data['message'];
        }, array_filter($this->message_bag, function (array $data) use ($message_type): bool {
            return $data['type'] == $message_type;
        }));
    }
    /**
     * Returns an array of all validation errors
     */
    public function get_validation_errors(): array
    {
        return $this->get_message_bag_filtered(static::MSG_TYPE_VALIDATIONERROR);
    }
    /**
     * Returns true if __no__ validation errors are present otherwise false
     */
    public function has_no_validation_errors(): bool
    {
        return $this->get_validation_errors() === [];
    }
    /**
     * Returns true if validation errors are present otherwise false
     */
    public function has_validation_errors(): bool
    {
        return !$this->has_no_validation_errors();
    }
    /**
     * Returns an array of all validation warnings
     */
    public function get_validation_warnings(): array
    {
        return $this->get_message_bag_filtered(static::MSG_TYPE_VALIDATIONWARNING);
    }
    /**
     * Returns true if __no__ validation warnings are present otherwise false
     */
    public function has_no_validation_warnings(): bool
    {
        return $this->get_validation_warnings() === [];
    }
    /**
     * Returns true if validation warnings are present otherwise false
     */
    public function has_validation_warnings(): bool
    {
        return !$this->has_no_validation_warnings();
    }
    /**
     * Returns an array of all validation information
     */
    public function get_validation_information(): array
    {
        return $this->get_message_bag_filtered(static::MSG_TYPE_VALIDATIONINFORMATION);
    }
    /**
     * Returns true if __no__ validation information are present otherwise false
     */
    public function has_no_validation_information(): bool
    {
        return $this->get_validation_information() === [];
    }
    /**
     * Returns true if validation Information are present otherwise false
     */
    public function has_validation_information(): bool
    {
        return !$this->has_no_validation_information();
    }
    /**
     * Return an array of all internal errors (such as download error or system exceptions)
     */
    public function get_process_errors(): array
    {
        return $this->get_message_bag_filtered(static::MSG_TYPE_INTERNALERROR);
    }
    /**
     * Returns true if there are __no__ system errors (e.g. exceptions before the validation app was called)
     */
    public function has_no_process_errors(): bool
    {
        return $this->get_process_errors() === [];
    }
    /**
     * Returns true if there are any system errors (e.g. exceptions before the validation app was called)
     */
    public function has_process_errors(): bool
    {
        return !$this->has_no_process_errors();
    }
    /**
     * Returns an array of all messages from process system (calling external applications)
     */
    public function get_process_output(): array
    {
        return $this->get_message_bag_filtered(static::MSG_TYPE_PROCESSOUTPUT);
    }
    /**
     * Check Requirements
     */
    private function check_requirements(): bool
    {
        if ($this->check_requirements_general() === false) {
            return false;
        }
        if ($this->remote_mode_enabled === true) {
            return $this->check_requirements_remote();
        }
        return $this->check_requirements_local();
    }
    /**
     * CHeck general requirements (common for local and remote validation)
     */
    private function check_requirements_general(): bool
    {
        if (is_null($this->document)) {
            $this->add_to_message_bag('You must specify an instance of the ZugferdDocument class');
            return false;
        }
        return true;
    }
    /**
     * CHeck requirements for usage on a local installation
     */
    private function check_requirements_local(): bool
    {
        if ($this->remote_mode_enabled === true) {
            return true;
        }
        if (!extension_loaded('zip')) {
            $this->add_to_message_bag('ZIP extension not installed');
            return false;
        }
        $executable_finder = new Executable_Finder();
        if (is_null($executable_finder->find('java'))) {
            $this->add_to_message_bag('JAVA not installed on this machine');
            return false;
        }
        return true;
    }
    /**
     * CHeck requirements for usage on a remote host which is running the application
     * in daemon mode
     */
    private function check_requirements_remote(): bool
    {
        if ($this->remote_mode_enabled !== true) {
            return true;
        }
        if (!extension_loaded('curl')) {
            $this->add_to_message_bag('PHP-Curl not installed or activated');
            return false;
        }
        if (String_Utils::string_is_null_or_empty($this->remote_mode_host)) {
            $this->add_to_message_bag("You must specify the hostname or it's IP where the Validator is running in daemon mode");
            return false;
        }
        if ($this->remote_mode_port <= 0) {
            $this->add_to_message_bag('You must specify the port of the host where the Validator is running in daemon mode');
            return false;
        }
        try {
            $http_connection = curl_init($this->get_remote_mode_url());
            curl_setopt($http_connection, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($http_connection, CURLOPT_HEADER, true);
            curl_setopt($http_connection, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($http_connection, CURLOPT_ENCODING, '');
            curl_setopt($http_connection, CURLOPT_AUTOREFERER, true);
            curl_setopt($http_connection, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($http_connection, CURLOPT_TIMEOUT, 120);
            $response = curl_exec($http_connection);
            if ($response === false) {
                $this->add_to_message_bag('Failed to connect to the host where the Validator is running in daemon mode');
                $this->add_to_message_bag(curl_error($http_connection));
                return false;
            }
            $response_status_code = curl_getinfo($http_connection, CURLINFO_HTTP_CODE);
            $response_error = curl_error($http_connection);
            if (PHP_VERSION_ID >= 80000) {
                unset($http_connection);
            } else {
                curl_close($http_connection);
            }
            if ($response_status_code < 200 || $response_status_code >= 400) {
                $this->add_to_message_bag('Failed to connect to the host where the Validator is running in daemon mode');
                $this->add_to_message_bag($response_error);
                return false;
            }
        } catch (Throwable $throwable) {
            $this->add_to_message_bag($throwable);
            return false;
        }
        return true;
    }
    /**
     * Download required files
     */
    private function download_required_files(): bool
    {
        if ($this->remote_mode_enabled === true) {
            return true;
        }
        if (!$this->run_file_download($this->validator_download_url, $this->resolve_app_zip_filename())) {
            $this->add_to_message_bag(sprintf('Unable to download from %s containing the JAVA-Application', $this->validator_download_url));
            return false;
        }
        if (!$this->run_file_download($this->validator_scenario_download_url, $this->resolve_scenatio_zip_filename())) {
            $this->add_to_message_bag(sprintf('Unable to download from %s containing the validation scenarios', $this->validator_scenario_download_url));
            return false;
        }
        return true;
    }
    /**
     * Unpack required files
     */
    private function unpack_required_files(): bool
    {
        if ($this->remote_mode_enabled === true) {
            return true;
        }
        $validator_app_file = $this->resolve_app_zip_filename();
        $validator_scenario_file = $this->resolve_scenatio_zip_filename();
        if (!$this->unpack_required_file($validator_app_file)) {
            $this->add_to_message_bag(sprintf('Unable to unpack archive %s containing the JAVA-Application', $validator_app_file));
            return false;
        }
        if (!$this->unpack_required_file($validator_scenario_file)) {
            $this->add_to_message_bag(sprintf('Unable to unpack archive %s containing the validation scenarios', $validator_scenario_file));
            return false;
        }
        return true;
    }
    /**
     * Unpack single required file
     */
    private function unpack_required_file(string $filename): bool
    {
        if ($this->remote_mode_enabled === true) {
            return true;
        }
        $zip_archive = new Zip_Archive();
        if ($zip_archive->open($filename) !== true) {
            $this->add_to_message_bag(sprintf('Failed to open ZIP archive %s', $filename));
            return false;
        }
        $num_files_exists = 0;
        for ($i = 0; $i < $zip_archive->num_files; $i++) {
            $zip_stat = $zip_archive->stat_index($i);
            $realfilename = Path_Utils::combine_path_with_file($this->resolve_base_directory(), $zip_stat['name']);
            if (file_exists($realfilename)) {
                $num_files_exists++;
            }
        }
        if ($num_files_exists == $zip_archive->num_files) {
            return true;
        }
        if (!$zip_archive->extract_to($this->resolve_base_directory())) {
            $zip_archive->close();
            $this->add_to_message_bag(sprintf('Failed to extract ZIP archive %s', $filename));
            return false;
        }
        $zip_archive->close();
        return true;
    }
    /**
     * Runs the validator java application
     */
    private function perform_validation(): bool
    {
        if ($this->remote_mode_enabled === true) {
            return $this->perform_validation_remote();
        }
        return $this->perform_validation_local();
    }
    /**
     * Runs the validator java application locally
     */
    private function perform_validation_local(): bool
    {
        if ($this->remote_mode_enabled === true) {
            return true;
        }
        $this->reset_file_to_validate_filename();
        if (file_put_contents($this->resolve_file_to_validate_filename(), $this->get_document_content()) === false) {
            $this->add_to_message_bag('Cannot create temporary file which contains the XML to validate');
            return false;
        }
        $application_options = ['java', '-jar', $this->resolve_app_jar_filename(), '-r', $this->resolve_base_directory(), '-s', $this->resolve_app_scenario_filename(), $this->resolve_file_to_validate_filename()];
        if (!$this->run_validation_application($application_options, $this->resolve_base_directory())) {
            $this->parse_validator_xml_report_by_file();
            return false;
        }
        return true;
    }
    /**
     * Runs the validator java application on the remote host
     */
    private function perform_validation_remote(): bool
    {
        if ($this->remote_mode_enabled !== true) {
            return true;
        }
        try {
            $http_connection = curl_init($this->get_remote_mode_url());
            curl_setopt($http_connection, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($http_connection, CURLOPT_HEADER, true);
            curl_setopt($http_connection, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($http_connection, CURLOPT_ENCODING, '');
            curl_setopt($http_connection, CURLOPT_AUTOREFERER, true);
            curl_setopt($http_connection, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($http_connection, CURLOPT_TIMEOUT, 120);
            curl_setopt($http_connection, CURLOPT_POST, true);
            curl_setopt($http_connection, CURLOPT_POSTFIELDS, $this->get_document_content());
            curl_setopt($http_connection, CURLOPT_HTTPHEADER, ['Content-Type: application/xml']);
            $response = curl_exec($http_connection);
            if ($response === false) {
                $this->add_to_message_bag('Failed to connect to the host where the Validator is running in daemon mode');
                $this->add_to_message_bag(curl_error($http_connection));
                return false;
            }
            $response_status_code = curl_getinfo($http_connection, CURLINFO_HTTP_CODE);
            if (PHP_VERSION_ID >= 80000) {
                unset($http_connection);
            } else {
                curl_close($http_connection);
            }
            if ($response_status_code < 200 || $response_status_code >= 400) {
                if (preg_match('/<\?xml.*?\?>.*<\/.+>/s', $response, $matches)) {
                    $this->parse_validator_xml_report_by_content($matches[0]);
                }
                return false;
            }
        } catch (Throwable $throwable) {
            $this->add_to_message_bag($throwable);
            return false;
        }
        return true;
    }
    /**
     * Parses the XML report from the validation app (JAVA application) and put errors
     * to messagebag
     */
    private function parse_validator_xml_report_by_file(): void
    {
        $report_filename = Path_Utils::combine_path_with_file($this->resolve_base_directory(), File_Utils::get_filename_without_extension($this->resolve_file_to_validate_filename()) . '-report.xml');
        if (!file_exists($report_filename)) {
            return;
        }
        $dom_document = new Dom_Document();
        $dom_document->load($report_filename);
        $this->parse_validator_xml_report_by_dom_document($dom_document);
    }
    /**
     * Parses the XML content string containing the response from the validation app (JAVA application) and put errors
     * to messagebag
     */
    private function parse_validator_xml_report_by_content(string $xml_content): void
    {
        if (String_Utils::string_is_null_or_empty($xml_content)) {
            return;
        }
        $dom_document = new Dom_Document();
        $dom_document->load_xml($xml_content);
        $this->parse_validator_xml_report_by_dom_document($dom_document);
    }
    /**
     * Parses the XML DOMDocument containing the response from the validation app (JAVA application) and put errors
     * to messagebag
     */
    private function parse_validator_xml_report_by_dom_document(Dom_Document $dom_document): void
    {
        $dom_x_path = new Domx_Path($dom_document);
        $message_type_maps = [static::MSG_TYPE_VALIDATIONERROR => 'error', static::MSG_TYPE_VALIDATIONWARNING => 'warning', static::MSG_TYPE_VALIDATIONINFORMATION => 'information'];
        $result_areas = ['val-xsd', 'val-sch.1', 'val-xml'];
        foreach ($result_areas as $result_area) {
            $query_result = $dom_x_path->query(sprintf("//rep:report/rep:scenarioMatched/rep:validationStepResult[@id='%s']/s:resource/s:name", $result_area));
            $resource_name = isset($query_result[0]) ? $query_result[0]->node_value : $result_area;
            foreach ($message_type_maps as $message_type => $report_message_type) {
                $query_result = $dom_x_path->query(sprintf("//rep:report/rep:scenarioMatched/rep:validationStepResult[@id='%s']/rep:message[@level='%s']", $result_area, $report_message_type));
                foreach ($query_result as $query_item) {
                    $this->add_to_message_bag(sprintf('%s: %s', $resource_name, $query_item->node_value), $message_type);
                }
            }
        }
    }
    /**
     * Cleanup downloads and created files
     */
    private function cleanup_base_directory(): void
    {
        if ($this->remote_mode_enabled === true) {
            return;
        }
        if ($this->cleanup_base_directory_is_disabled === true) {
            return;
        }
        if (!is_dir($this->resolve_base_directory())) {
            return;
        }
        $this->cleanup_base_directory_internal($this->resolve_base_directory());
    }
    /**
     * Helper method for removeBaseDirectory
     */
    private function cleanup_base_directory_internal(string $directory_to_remove): void
    {
        if ($this->remote_mode_enabled === true) {
            return;
        }
        if (!is_dir($directory_to_remove)) {
            return;
        }
        $objects = scandir($directory_to_remove);
        foreach ($objects as $object) {
            if ($object !== '.' && $object !== '..') {
                $full_filename = Path_Utils::combine_path_with_file($directory_to_remove, $object);
                if (is_dir($full_filename) && !is_link($full_filename)) {
                    $this->cleanup_base_directory_internal($full_filename);
                } else {
                    unlink($full_filename);
                }
            }
        }
        rmdir($directory_to_remove);
    }
    /**
     * Runs a process. If the process runned successfully this method
     * returns true, otherwise false
     */
    private function run_validation_application(array $command, string $workingdirectory): bool
    {
        try {
            $process = new Process($command);
            $process->set_timeout(0.0);
            $process->set_working_directory($workingdirectory);
            $process->run();
            foreach (preg_split("/\r\n|\n|\r/", $process->get_output()) as $output_line) {
                $this->add_to_message_bag($output_line, static::MSG_TYPE_PROCESSOUTPUT);
            }
            if (!$process->is_successful()) {
                if ($process->get_exit_code() == -1) {
                    $this->add_to_message_bag('Parsing error. The commandline arguments specified are incorrect', static::MSG_TYPE_VALIDATIONERROR);
                }
                if ($process->get_exit_code() == -2) {
                    $this->add_to_message_bag('Configuration error. There is an error loading the configuration and/or validation targets', static::MSG_TYPE_VALIDATIONERROR);
                }
                if ($process->get_exit_code() > 0) {
                    $this->add_to_message_bag('Validation error. One ore more files were rejected', static::MSG_TYPE_VALIDATIONERROR);
                }
                return false;
            }
        } catch (Throwable $throwable) {
            $this->add_to_message_bag($throwable, static::MSG_TYPE_VALIDATIONERROR);
            return false;
        }
        return true;
    }
    /**
     * Run a file download.
     */
    private function run_file_download(string $url, string $to_file_path, bool $force_overwrite = false): bool
    {
        try {
            if (file_exists($to_file_path) && !$force_overwrite) {
                return true;
            }
            file_put_contents($to_file_path, file_get_contents($url));
        } catch (Throwable $throwable) {
            $this->add_to_message_bag($throwable);
            return false;
        }
        return true;
    }
}
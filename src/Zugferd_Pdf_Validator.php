<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use horstoeko\stringmanagement\Path_Utils;
use horstoeko\stringmanagement\String_Utils;
use horstoeko\zugferd\exception\Zugferd_File_Not_Found_Exception;
use horstoeko\zugferd\exception\Zugferd_File_Not_Readable_Exception;
use LogicException;
use Symfony\Component\Finder\Exception\Directory_Not_Found_Exception;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Executable_Finder;
use Symfony\Component\Process\Process;
use Throwable;
use Zip_Archive;
/**
 * Class representing the validator against PDF files using VeraPDF.
 * This class requires a JAVA running setup
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Pdf_Validator
{
    /**
     * The PDF content
     *
     * @var string|null
     */
    private $pdf_content;
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
     * VeraPDF Validator download url
     *
     * @var string
     */
    private $validator_download_url = 'https://software.verapdf.org/rel/verapdf-installer.zip';
    /**
     * The filename of the validation application zip archive
     *
     * @var string $validatorAppZipFilename
     */
    private $validator_app_zip_filename = 'verapdf-installer.zip';
    /**
     * The ruleset to use
     * Allowed values are 0, 1a, 1b, 2a, 2b, 2u, 3a, 3b, 3u, 4, 4f, 4e, ua1, ua2
     *
     * @var string
     */
    private $validator_ruleset = '3a';
    /**
     * The temporary filename which contains the PDF data to validate
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
     * Ruleset for Automatic detection based on a file's metadata
     */
    public const RULESET_PDF_A_0 = '0';
    /**
     * Ruleset PDF/A-1A validation profile
     */
    public const RULESET_PDF_A_1A = '1a';
    /**
     * Ruleset PDF/A-1B validation profile
     */
    public const RULESET_PDF_A_1B = '1b';
    /**
     * Ruleset PDF/A-2A validation profile
     */
    public const RULESET_PDF_A_2A = '2a';
    /**
     * Ruleset PDF/A-2B validation profile
     */
    public const RULESET_PDF_A_2B = '2b';
    /**
     * Ruleset PDF/A-2U validation profile
     */
    public const RULESET_PDF_A_2U = '2u';
    /**
     * Ruleset PDF/A-3A validation profile
     */
    public const RULESET_PDF_A_3A = '3a';
    /**
     * Ruleset PDF/A-3B validation profile
     */
    public const RULESET_PDF_A_3B = '3b';
    /**
     * Ruleset PDF/A-3U validation profile
     */
    public const RULESET_PDF_A_3U = '3u';
    /**
     * Ruleset PDF/A-4 validation profile
     */
    public const RULESET_PDF_A_4 = '4';
    /**
     * Ruleset PDF/A-4F validation profile
     */
    public const RULESET_PDF_A_4F = '4f';
    /**
     * Ruleset PDF/A-4E validation profile
     */
    public const RULESET_PDF_A_4E = '4e';
    /**
     * Ruleset PDF/UA-1 validation profile
     */
    public const RULESET_PDF_UA_1 = 'ua1';
    /**
     * Ruleset PDF/UA-2 + Tagged PDF validation profile
     */
    public const RULESET_PDF_UA_2 = 'ua2';
    /**
     * Create a ZugferdPdfValidator-Instance by an existing PDF-File
     */
    public static function from_file(string $pdf_filename): Zugferd_Pdf_Validator
    {
        if (!file_exists($pdf_filename)) {
            throw new Zugferd_File_Not_Found_Exception($pdf_filename);
        }
        $pdf_content = file_get_contents($pdf_filename);
        if ($pdf_content === false) {
            throw new Zugferd_File_Not_Readable_Exception($pdf_filename);
        }
        return Zugferd_Pdf_Validator::from_content($pdf_content);
    }
    /**
     * Create a ZugferdPdfValidator-Instance by a given content string
     */
    public static function from_content(string $pdf_content): Zugferd_Pdf_Validator
    {
        return new Zugferd_Pdf_Validator($pdf_content);
    }
    /**
     * Constructor
     */
    final protected function __construct(?string $pdf_content = null)
    {
        $this->set_base_directory(sys_get_temp_dir());
        $this->set_pdf_content($pdf_content);
    }
    /**
     * Set the PDF content to validate
     */
    public function set_pdf_content(string $pdf_content): Zugferd_Pdf_Validator
    {
        $this->pdf_content = $pdf_content;
        return $this;
    }
    /**
     * Setup the base directory. In the base directory all files will be downloaded
     * and created
     */
    public function set_base_directory(string $new_base_directory): Zugferd_Pdf_Validator
    {
        if (is_dir($new_base_directory)) {
            $this->base_directory = $new_base_directory;
        }
        return $this;
    }
    /**
     * Setup the VeraPDF validator application download url
     */
    public function set_validator_download_url(string $new_validator_download_url): Zugferd_Pdf_Validator
    {
        if (filter_var($new_validator_download_url, FILTER_VALIDATE_URL) !== false) {
            $this->validator_download_url = $new_validator_download_url;
        }
        return $this;
    }
    /**
     * Set the filename of the ZIP file which contains the validation application
     */
    public function set_validator_app_zip_filename(string $new_validator_app_zip_filename): Zugferd_Pdf_Validator
    {
        $this->validator_app_zip_filename = $new_validator_app_zip_filename;
        return $this;
    }
    /**
     * Set the Ruleset to use for validation.
     * Allowed values are 0, 1a, 1b, 2a, 2b, 2u, 3a, 3b, 3u, 4, 4f, 4e, ua1, ua2
     */
    public function set_validator_ruleset(string $new_vlidator_ruleset): Zugferd_Pdf_Validator
    {
        $new_vlidator_ruleset = strtolower($new_vlidator_ruleset);
        if (in_array($new_vlidator_ruleset, [static::RULESET_PDF_A_0, static::RULESET_PDF_A_1A, static::RULESET_PDF_A_1B, static::RULESET_PDF_A_2A, static::RULESET_PDF_A_2B, static::RULESET_PDF_A_2U, static::RULESET_PDF_A_3A, static::RULESET_PDF_A_3B, static::RULESET_PDF_A_3U, static::RULESET_PDF_A_4, static::RULESET_PDF_A_4E, static::RULESET_PDF_A_4F, static::RULESET_PDF_UA_1, static::RULESET_PDF_UA_2])) {
            $this->validator_ruleset = $new_vlidator_ruleset;
        }
        return $this;
    }
    /**
     * Disable cleanup base directory
     */
    public function disable_cleanup(): Zugferd_Pdf_Validator
    {
        $this->cleanup_base_directory_is_disabled = true;
        return $this;
    }
    /**
     * Enable cleanup base directory
     */
    public function enable_cleanup(): Zugferd_Pdf_Validator
    {
        $this->cleanup_base_directory_is_disabled = false;
        return $this;
    }
    /**
     * Perform validation
     */
    public function validate(): Zugferd_Pdf_Validator
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
        if ($this->install_validator() === false) {
            $this->cleanup_base_directory();
            return $this;
        }
        $this->perform_validation();
        $this->cleanup_base_directory();
        return $this;
    }
    /**
     * Internal get (and create) the directory for downloads and file creation
     */
    private function resolve_base_directory(): string
    {
        $base_directory_suffix = md5($this->validator_download_url);
        $base_directory = Path_Utils::combine_path_with_path($this->base_directory, sprintf('verapdf-%s', $base_directory_suffix));
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
     * Get the executable of the validator
     */
    private function resolve_validator_executable(): string
    {
        return Path_Utils::combine_path_with_file($this->resolve_base_directory(), 'verapdf');
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
            $this->file_to_validate_filename = Path_Utils::combine_path_with_file($this->resolve_base_directory(), sprintf('filetovalidate-%s-%s.pdf', uniqid(), uniqid()));
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
        if (is_null($this->pdf_content)) {
            $this->add_to_message_bag('You must specify the content or a filename of a PDF to validate');
            return false;
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
     * Download required files
     */
    private function download_required_files(): bool
    {
        if (!$this->run_file_download($this->validator_download_url, $this->resolve_app_zip_filename())) {
            $this->add_to_message_bag(sprintf('Unable to download from %s containing the JAVA-Application', $this->validator_download_url));
            return false;
        }
        return true;
    }
    /**
     * Unpack required files
     */
    private function unpack_required_files(): bool
    {
        $validator_app_file = $this->resolve_app_zip_filename();
        if (!$this->unpack_required_file($validator_app_file, true)) {
            $this->add_to_message_bag(sprintf('Unable to unpack archive %s containing the JAVA-Application', $validator_app_file));
            return false;
        }
        return true;
    }
    /**
     * Unpack single required file
     */
    private function unpack_required_file(string $zip_filename, bool $flat_extraction = false): bool
    {
        if ($flat_extraction) {
            return $this->unpack_required_file_flat($zip_filename);
        }
        return $this->unpack_required_file_non_flat($zip_filename);
    }
    /**
     * Unpack single required file (Non-Flat)
     */
    private function unpack_required_file_non_flat(string $zip_filename): bool
    {
        $zip_archive = new Zip_Archive();
        if ($zip_archive->open($zip_filename) !== true) {
            $this->add_to_message_bag(sprintf('Failed to open ZIP archive %s', $zip_filename));
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
            $this->add_to_message_bag(sprintf('Failed to extract ZIP archive %s', $zip_filename));
            return false;
        }
        $zip_archive->close();
        return true;
    }
    /**
     * Unpack single required file (Flat)
     */
    private function unpack_required_file_flat(string $zip_filename): bool
    {
        $zip_archive = new Zip_Archive();
        if ($zip_archive->open($zip_filename) !== true) {
            $this->add_to_message_bag(sprintf('Failed to open ZIP archive %s', $zip_filename));
            return false;
        }
        for ($i = 0; $i < $zip_archive->num_files; $i++) {
            $filename_in_zip = $zip_archive->get_name_index($i);
            if (substr($filename_in_zip, -1) === '/') {
                continue;
            }
            $realfilename = $this->resolve_base_directory() . DIRECTORY_SEPARATOR . basename($filename_in_zip);
            if (file_exists($realfilename)) {
                continue;
            }
            if (!copy('zip://' . realpath($zip_filename) . '#' . $filename_in_zip, $realfilename)) {
                $zip_archive->close();
                $this->add_to_message_bag(sprintf('Failed to extract %s', $filename_in_zip));
                return false;
            }
        }
        $zip_archive->close();
        return true;
    }
    /**
     * Install the validator
     *
     * @throws DirectoryNotFoundException
     * @throws LogicException
     */
    private function install_validator(): bool
    {
        if (file_exists($this->resolve_validator_executable())) {
            return true;
        }
        $installer_jar_finder = new Finder();
        $installer_jar_finder->files()->name('verapdf-izpack-installer*.jar')->in($this->resolve_base_directory());
        if ($installer_jar_finder->has_results() === false) {
            $this->add_to_message_bag('There was no installer in the form of a JAR-File found');
            return false;
        }
        $installer_script_filename = Path_Utils::combine_path_with_file($this->resolve_base_directory(), 'install.xml');
        if (file_put_contents($installer_script_filename, sprintf('<?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <AutomatedInstallation langpack="eng">
                <com.izforge.izpack.panels.htmlhello.HTMLHelloPanel id="welcome"/>
                <com.izforge.izpack.panels.target.TargetPanel id="install_dir">
                    <installpath>%s</installpath>
                </com.izforge.izpack.panels.target.TargetPanel>
                <com.izforge.izpack.panels.packs.PacksPanel id="sdk_pack_select">
                    <pack index="0" name="veraPDF Mac and *nix Scripts" selected="true"/>
                    <pack index="1" name="veraPDF Validation model" selected="true"/>
                    <pack index="2" name="veraPDF Documentation" selected="true"/>
                    <pack index="3" name="veraPDF Sample Plugins" selected="true"/>
                </com.izforge.izpack.panels.packs.PacksPanel>
                <com.izforge.izpack.panels.install.InstallPanel id="install"/>
                <com.izforge.izpack.panels.finish.FinishPanel id="finish"/>
            </AutomatedInstallation>', $this->resolve_base_directory())) === false) {
            $this->add_to_message_bag('Failed to create install script');
            return false;
        }
        $installer_jar_iterator = $installer_jar_finder->getIterator();
        $installer_jar_iterator->rewind();
        $installer_jar_filename = $installer_jar_iterator->current()->get_pathname();
        $installer_jar_options = ['java', '-jar', $installer_jar_filename, $installer_script_filename];
        if ($this->run_process($installer_jar_options, $this->resolve_base_directory()) === false) {
            $this->add_to_message_bag('Failed to run installer');
            return false;
        }
        return true;
    }
    /**
     * Runs the validator java application
     */
    private function perform_validation(): bool
    {
        if (!file_exists($this->resolve_validator_executable())) {
            $this->add_to_message_bag('Validation application not found');
            return false;
        }
        $this->reset_file_to_validate_filename();
        if (file_put_contents($this->resolve_file_to_validate_filename(), $this->pdf_content) === false) {
            $this->add_to_message_bag('Cannot create temporary file which contains the PDF to validate');
            return false;
        }
        $validator_executable_options = [$this->resolve_validator_executable(), '--format', 'json', '--flavour', $this->validator_ruleset, $this->resolve_file_to_validate_filename()];
        if ($this->run_process_and_get_output($validator_executable_options, $this->resolve_base_directory(), $validator_executable_output) === false) {
            $this->check_validator_executable_output($validator_executable_output);
            return false;
        }
        return $this->check_validator_executable_output($validator_executable_output);
    }
    /**
     * Read and parse the JSON response
     */
    private function check_validator_executable_output(string $validator_executable_output): bool
    {
        $validator_executable_output_object = json_decode($validator_executable_output);
        if ($validator_executable_output_object === null && json_last_error() !== JSON_ERROR_NONE) {
            $this->add_to_message_bag(sprintf('Cannot decode JSON result. Error %s', json_last_error_msg()), static::MSG_TYPE_VALIDATIONERROR);
            return false;
        }
        if (!isset($validator_executable_output_object->report)) {
            $this->add_to_message_bag('Invalid report response - no report property found', static::MSG_TYPE_VALIDATIONERROR);
            return false;
        }
        if (!isset($validator_executable_output_object->report->jobs)) {
            $this->add_to_message_bag('Invalid report response - no jobs property found', static::MSG_TYPE_VALIDATIONERROR);
            return false;
        }
        if (!is_array($validator_executable_output_object->report->jobs)) {
            $this->add_to_message_bag('Invalid report response - jobs property is not an array', static::MSG_TYPE_VALIDATIONERROR);
            return false;
        }
        if (count($validator_executable_output_object->report->jobs) != 1) {
            $this->add_to_message_bag('Invalid report response - jobs property should be an array with one element', static::MSG_TYPE_VALIDATIONERROR);
            return false;
        }
        $validator_executable_output_job_object = $validator_executable_output_object->report->jobs[0];
        if (!isset($validator_executable_output_job_object->validation_result)) {
            $this->add_to_message_bag('Invalid report response - job has not a validationResult property', static::MSG_TYPE_VALIDATIONERROR);
            return false;
        }
        if (!isset($validator_executable_output_job_object->validation_result->details)) {
            $this->add_to_message_bag('Invalid report response - job has not a details property', static::MSG_TYPE_VALIDATIONERROR);
            return false;
        }
        if (!isset($validator_executable_output_job_object->validation_result->details->failed_rules)) {
            $this->add_to_message_bag('Invalid report response - job has not a failedRules property', static::MSG_TYPE_VALIDATIONERROR);
            return false;
        }
        if (!isset($validator_executable_output_job_object->validation_result->details->failed_checks)) {
            $this->add_to_message_bag('Invalid report response - job has not a failedChecks property', static::MSG_TYPE_VALIDATIONERROR);
            return false;
        }
        if ($validator_executable_output_job_object->validation_result->details->failed_rules == 0 && $validator_executable_output_job_object->validation_result->details->failed_checks == 0) {
            return true;
        }
        $this->add_to_message_bag(sprintf('Validation failed. Failed rules: %s, Failed Checks: %s', $validator_executable_output_job_object->validation_result->details->failed_rules, $validator_executable_output_job_object->validation_result->details->failed_checks), static::MSG_TYPE_VALIDATIONERROR);
        foreach ($validator_executable_output_job_object->validation_result->details->rule_summaries ?? [] as $rule_summary) {
            $this->add_to_message_bag(sprintf('%s, %s, %s --> %s', $rule_summary->specification, $rule_summary->clause, $rule_summary->object, $rule_summary->description), static::MSG_TYPE_VALIDATIONERROR);
        }
        return false;
    }
    /**
     * Cleanup downloads and created files
     */
    private function cleanup_base_directory(): void
    {
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
    private function run_process(array $command, string $workingdirectory): bool
    {
        return $this->run_process_and_get_output($command, $workingdirectory, $_);
    }
    /**
     * Runs a process. If the process runned successfully this method
     * returns true, otherwise false. The output of the process wil be
     * returned in $processOutput
     */
    private function run_process_and_get_output(array $command, string $workingdirectory, ?string &$process_output): bool
    {
        try {
            $process = new Process($command);
            $process->set_timeout(0.0);
            $process->set_working_directory($workingdirectory);
            $process->run();
            $process_output = $process->get_output();
            foreach (preg_split("/\r\n|\n|\r/", $process_output) as $output_line) {
                $this->add_to_message_bag($output_line, static::MSG_TYPE_PROCESSOUTPUT);
            }
            if (!$process->is_successful()) {
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
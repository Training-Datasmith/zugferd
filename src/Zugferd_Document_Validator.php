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
use Symfony\Component\Validator\Constraint_Violation_List_Interface;
use Symfony\Component\Validator\Validation;
/**
 * Class representing the document validator for incoming documents
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Document_Validator
{
    /**
     * The invoice document reference
     */
    private $document;
    /**
     * The validator instance
     */
    private $validator;
    /**
     * Constructor
     */
    public function __construct(Zugferd_Document $document)
    {
        $this->document = $document;
        $this->init_validator();
    }
    /**
     * Perform the validation of the document
     */
    public function validate_document(): Constraint_Violation_List_Interface
    {
        return $this->validator->validate($this->get_document_invoice_object(), null, ['xsd_rules']);
    }
    /**
     * Initialize the internal validator object
     */
    private function init_validator(): void
    {
        $validator_builder = Validation::create_validator_builder();
        $validator_yaml_files = Path_Utils::combine_path_with_file(Path_Utils::combine_all_paths(Zugferd_Settings::get_validation_directory(), $this->document->get_profile_definition_parameter('name')), '*.yml');
        $validator_yaml_files = $this->glob_recursive($validator_yaml_files);
        foreach ($validator_yaml_files as $validator_yaml_file) {
            $validator_builder->add_yaml_mapping($validator_yaml_file);
        }
        $this->validator = $validator_builder->get_validator();
    }
    /**
     * Helper for find all files by pattern
     */
    private function glob_recursive(string $pattern, int $flags = 0): array
    {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge($files, $this->glob_recursive($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }
    /**
     * Returns the internal invoice object from the document
     *
     * @return object
     */
    private function get_document_invoice_object()
    {
        $reflector = new \ReflectionClass($this->document);
        $method = $reflector->get_method('getInvoiceObject');
        $method->set_accessible(true);
        return $method->invoke($this->document);
    }
}
<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ExchangedDocumentContextType
 *
 * XSD Type: ExchangedDocumentContextType
 */
class Exchanged_Document_Context_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IndicatorType $testIndicator
     */
    private $test_indicator;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType $businessProcessSpecifiedDocumentContextParameter
     */
    private $business_process_specified_document_context_parameter;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType $guidelineSpecifiedDocumentContextParameter
     */
    private $guideline_specified_document_context_parameter;
    /**
     * Gets as testIndicator
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IndicatorType
     */
    public function get_test_indicator()
    {
        return $this->test_indicator;
    }
    /**
     * Sets a new testIndicator
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IndicatorType $testIndicator
     */
    public function set_test_indicator(?\horstoeko\zugferd\entities\extended\udt\Indicator_Type $test_indicator = null): self
    {
        $this->test_indicator = $test_indicator;
        return $this;
    }
    /**
     * Gets as businessProcessSpecifiedDocumentContextParameter
     *
     * @return \horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType
     */
    public function get_business_process_specified_document_context_parameter()
    {
        return $this->business_process_specified_document_context_parameter;
    }
    /**
     * Sets a new businessProcessSpecifiedDocumentContextParameter
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType $businessProcessSpecifiedDocumentContextParameter
     */
    public function set_business_process_specified_document_context_parameter(?\horstoeko\zugferd\entities\extended\ram\Document_Context_Parameter_Type $business_process_specified_document_context_parameter = null): self
    {
        $this->business_process_specified_document_context_parameter = $business_process_specified_document_context_parameter;
        return $this;
    }
    /**
     * Gets as guidelineSpecifiedDocumentContextParameter
     *
     * @return \horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType
     */
    public function get_guideline_specified_document_context_parameter()
    {
        return $this->guideline_specified_document_context_parameter;
    }
    /**
     * Sets a new guidelineSpecifiedDocumentContextParameter
     */
    public function set_guideline_specified_document_context_parameter(\horstoeko\zugferd\entities\extended\ram\Document_Context_Parameter_Type $guideline_specified_document_context_parameter): self
    {
        $this->guideline_specified_document_context_parameter = $guideline_specified_document_context_parameter;
        return $this;
    }
}
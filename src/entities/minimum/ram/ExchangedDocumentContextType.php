<?php

namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing ExchangedDocumentContextType
 *
 * XSD Type: ExchangedDocumentContextType
 */
class ExchangedDocumentContextType
{

    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\DocumentContextParameterType $businessProcessSpecifiedDocumentContextParameter
     */
    private $businessProcessSpecifiedDocumentContextParameter;

    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\DocumentContextParameterType $guidelineSpecifiedDocumentContextParameter
     */
    private $guidelineSpecifiedDocumentContextParameter;

    /**
     * Gets as businessProcessSpecifiedDocumentContextParameter
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\DocumentContextParameterType
     */
    public function getBusinessProcessSpecifiedDocumentContextParameter()
    {
        return $this->businessProcessSpecifiedDocumentContextParameter;
    }

    /**
     * Sets a new businessProcessSpecifiedDocumentContextParameter
     *
     * @param  \horstoeko\zugferd\entities\minimum\ram\DocumentContextParameterType $businessProcessSpecifiedDocumentContextParameter
     */
    public function setBusinessProcessSpecifiedDocumentContextParameter(?\horstoeko\zugferd\entities\minimum\ram\DocumentContextParameterType $businessProcessSpecifiedDocumentContextParameter = null): self
    {
        $this->businessProcessSpecifiedDocumentContextParameter = $businessProcessSpecifiedDocumentContextParameter;
        return $this;
    }

    /**
     * Gets as guidelineSpecifiedDocumentContextParameter
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\DocumentContextParameterType
     */
    public function getGuidelineSpecifiedDocumentContextParameter()
    {
        return $this->guidelineSpecifiedDocumentContextParameter;
    }

    /**
     * Sets a new guidelineSpecifiedDocumentContextParameter
     */
    public function setGuidelineSpecifiedDocumentContextParameter(\horstoeko\zugferd\entities\minimum\ram\DocumentContextParameterType $guidelineSpecifiedDocumentContextParameter): self
    {
        $this->guidelineSpecifiedDocumentContextParameter = $guidelineSpecifiedDocumentContextParameter;
        return $this;
    }
}

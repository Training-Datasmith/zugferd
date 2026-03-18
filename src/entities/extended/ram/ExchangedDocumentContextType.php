<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ExchangedDocumentContextType
 *
 * XSD Type: ExchangedDocumentContextType
 */
class ExchangedDocumentContextType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IndicatorType $testIndicator
     */
    private $testIndicator;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType $businessProcessSpecifiedDocumentContextParameter
     */
    private $businessProcessSpecifiedDocumentContextParameter;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType $guidelineSpecifiedDocumentContextParameter
     */
    private $guidelineSpecifiedDocumentContextParameter;

    /**
     * Gets as testIndicator
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IndicatorType
     */
    public function getTestIndicator()
    {
        return $this->testIndicator;
    }

    /**
     * Sets a new testIndicator
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IndicatorType $testIndicator
     */
    public function setTestIndicator(?\horstoeko\zugferd\entities\extended\udt\IndicatorType $testIndicator = null): self
    {
        $this->testIndicator = $testIndicator;
        return $this;
    }

    /**
     * Gets as businessProcessSpecifiedDocumentContextParameter
     *
     * @return \horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType
     */
    public function getBusinessProcessSpecifiedDocumentContextParameter()
    {
        return $this->businessProcessSpecifiedDocumentContextParameter;
    }

    /**
     * Sets a new businessProcessSpecifiedDocumentContextParameter
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType $businessProcessSpecifiedDocumentContextParameter
     */
    public function setBusinessProcessSpecifiedDocumentContextParameter(?\horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType $businessProcessSpecifiedDocumentContextParameter = null): self
    {
        $this->businessProcessSpecifiedDocumentContextParameter = $businessProcessSpecifiedDocumentContextParameter;
        return $this;
    }

    /**
     * Gets as guidelineSpecifiedDocumentContextParameter
     *
     * @return \horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType
     */
    public function getGuidelineSpecifiedDocumentContextParameter()
    {
        return $this->guidelineSpecifiedDocumentContextParameter;
    }

    /**
     * Sets a new guidelineSpecifiedDocumentContextParameter
     */
    public function setGuidelineSpecifiedDocumentContextParameter(\horstoeko\zugferd\entities\extended\ram\DocumentContextParameterType $guidelineSpecifiedDocumentContextParameter): self
    {
        $this->guidelineSpecifiedDocumentContextParameter = $guidelineSpecifiedDocumentContextParameter;
        return $this;
    }
}

<?php

namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing ExchangedDocumentType
 *
 * XSD Type: ExchangedDocumentType
 */
class ExchangedDocumentType
{

    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\IDType $iD
     */
    private $iD;

    /**
     * @var string $typeCode
     */
    private $typeCode;

    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\DateTimeType $issueDateTime
     */
    private $issueDateTime;

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     */
    public function setID(\horstoeko\zugferd\entities\minimum\udt\IDType $iD): self
    {
        $this->iD = $iD;
        return $this;
    }

    /**
     * Gets as typeCode
     *
     * @return string
     */
    public function getTypeCode()
    {
        return $this->typeCode;
    }

    /**
     * Sets a new typeCode
     *
     * @param  string $typeCode
     */
    public function setTypeCode($typeCode): self
    {
        $this->typeCode = $typeCode;
        return $this;
    }

    /**
     * Gets as issueDateTime
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\DateTimeType
     */
    public function getIssueDateTime()
    {
        return $this->issueDateTime;
    }

    /**
     * Sets a new issueDateTime
     */
    public function setIssueDateTime(\horstoeko\zugferd\entities\minimum\udt\DateTimeType $issueDateTime): self
    {
        $this->issueDateTime = $issueDateTime;
        return $this;
    }
}

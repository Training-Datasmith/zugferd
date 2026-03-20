# Architecture: zugferd

## Purpose

A PHP library for creating, reading, and validating ZUGFeRD/Factur-X electronic invoice documents. ZUGFeRD embeds a structured XML invoice (based on the EN 16931 European standard) into a PDF/A file, enabling both human-readable and machine-processable invoices from a single file.

## Directory Structure

```
src/
  Zugferd_Document_Builder.php         - Fluent builder: construct an invoice document programmatically
  Zugferd_Document_Reader.php          - Parse an existing XML invoice into typed PHP objects
  Zugferd_Document.php                 - Core document model holding all invoice data
  Zugferd_Document_Pdf_Builder.php     - Embed XML invoice into a PDF/A file
  Zugferd_Document_Pdf_Builder_Abstract.php
  Zugferd_Document_Pdf_Merger.php      - Merge XML with an existing PDF
  Zugferd_Document_Pdf_Reader.php      - Extract and parse the XML attachment from a PDF
  Zugferd_Document_Pdf_Reader_Ext.php  - Extended PDF reader with additional metadata access
  Zugferd_Document_Validator.php       - Validate a document against the EN 16931 rules
  Zugferd_Document_Json_Exporter.php   - Export a document to JSON representation
  Zugferd_Document_Profile_Converter.php - Convert between ZUGFeRD profiles (Minimum, EN16931, Extended)
  Zugferd_Kosit_Validator.php          - Validate via the KOSIT online validation service
  Zugferd_Pdf_Validator.php            - Validate PDF/A conformance of the output
  Zugferd_Profile_Resolver.php         - Detect the ZUGFeRD profile from an XML document
  Zugferd_Profiles.php                 - Profile constants (MINIMUM, BASIC, EN16931, EXTENDED, XRECHNUNG)
  Zugferd_Settings.php                 - Global library settings (date format, PDF version, etc.)
  Zugferd_Object_Helper.php            - Utility: create and populate JMS-serialized XML entity objects
  Zugferd_Pdf_Writer.php               - Low-level PDF binary manipulation for embedding XML
  assets/                              - XSD schemas and Schematron rules for validation
  codelists/                           - EN 16931 code list data (currencies, units, tax codes, etc.)
  codelistsenum/                       - PHP enums for code list values
  entities/                            - JMS Serializer entity classes mapping to CII XML elements
  exception/                           - Domain exceptions (file not found, unknown profile, etc.)
  jms/                                 - JMS Serializer configuration for XML serialization
  quick/                               - Quick descriptor classes for common invoice profiles
  schema/                              - Additional XML schema files
  validation/                          - Schematron and XSD validation rule files
```

## Key Design Decisions

- **Profile-based architecture**: ZUGFeRD defines multiple conformance profiles (Minimum, Basic, EN16931, Extended, XRechnung). The library resolves the profile from the XML namespace and enforces profile-specific field requirements.
- **JMS Serializer for XML**: The CII (Cross-Industry Invoice) XML format is mapped to PHP entity classes and serialized/deserialized using JMS Serializer, avoiding hand-rolled XML generation.
- **PDF/A embedding**: The library embeds the invoice XML as a named attachment (`factur-x.xml` or `zugferd-invoice.xml`) in a PDF/A-3 file, conforming to the embedding requirements of the standard.
- **Quick descriptors**: The `quick/` directory provides simplified builder classes for the most common profiles (EN16931, XRechnung), reducing the API surface for typical use cases.
- **Multiple validation layers**: Documents can be validated against XSD schemas, EN 16931 Schematron rules, and optionally the remote KOSIT validator service.

## Extension Points

- Implement a custom validator by calling `Zugferd_Document_Validator` with custom rule files.
- Use `Zugferd_Document_Profile_Converter` to convert documents between profiles as needed by trading partners.

## Dependency Flow

```
// Building an invoice
Zugferd_Document_Builder::create_new(Zugferd_Profiles::PROFILE_EN16931)
  └─> set seller, buyer, line items, tax, payment terms
  └─> Zugferd_Document_Pdf_Builder::attach_to_existing_pdf('invoice.pdf')
        └─> Zugferd_Pdf_Writer — embed XML into PDF/A-3 binary

// Reading an invoice
Zugferd_Document_Pdf_Reader::read_and_get_document('invoice.pdf')
  └─> extract XML attachment from PDF
  └─> Zugferd_Profile_Resolver — detect profile
  └─> JMS Serializer — deserialize XML → entity objects
  └─> Zugferd_Document_Reader — typed accessor methods
```

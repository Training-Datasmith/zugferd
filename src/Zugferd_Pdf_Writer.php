<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use setasign\Fpdi\Fpdi as PdfFpdi;
/**
 * Class representing some tools for pdf generation
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Pdf_Writer extends Pdf_Fpdi
{
    /**
     * Contains all attached files
     *
     * @var array
     */
    protected $files = [];
    /**
     * Contains meta data
     *
     * @var array
     */
    protected $meta_data_descriptions = [];
    /**
     * Contains meta data
     *
     * @var array
     */
    protected $meta_data_infos = [];
    /**
     * Internal index
     *
     * @var integer
     */
    protected $file_spec_dictionnary_index = 0;
    /**
     * Internal index
     *
     * @var integer
     */
    protected $description_index = 0;
    /**
     * Internal index
     *
     * @var integer
     */
    protected $output_intent_index = 0;
    /**
     * Internal index
     *
     * @var integer
     */
    protected $files_index;
    /**
     * Internal flag that indicates that the attachment
     * pane should be shown by default
     *
     * @var boolean
     */
    protected $open_attachment_pane = false;
    /**
     * Internal flag deterministic mode. This mode should only be used
     * for testing purposes
     *
     * @var boolean
     */
    protected $deterministic_mode_enabled = false;
    /**
     * Set the PDF version.
     *
     * @param  string $version     Contains the PDF version number.
     * @param  bool   $binary_data This is true for binary data
     */
    public function set_pdf_version($version = '1.3', $binary_data = false): void
    {
        $this->pdf_version = sprintf('%.1F', $version);
        if (true == $binary_data) {
            if ($this->deterministic_mode_enabled === true) {
                $this->pdf_version .= "\n" . '%' . chr(128) . chr(129) . chr(130) . chr(131);
            } else {
                $this->pdf_version .= "\n" . '%' . chr(random_int(128, 255)) . chr(random_int(128, 255)) . chr(random_int(128, 255)) . chr(random_int(128, 255));
            }
        }
    }
    /**
     * Attach file to PDF.
     *
     * @param  mixed  $file
     * Data to embed to the pdf
     * @param  string $name
     * The visible attachment filename
     * @param  string $desc
     * The description for the attached file
     * @param  string $relationship
     * The type of the relationship of the attached file
     * @param  string $mimetype
     * The url-encoded mimetype of the attached file
     * @param  bool   $isUTF8
     * Set to true, if the attached file is UTF-8 encoded
     */
    public function attach($file, $name = '', $desc = '', $relationship = 'Unspecified', $mimetype = '', $is_utf8 = false): void
    {
        if ('' == $name) {
            $p = strrpos($file, '/');
            if (false === $p) {
                $p = strrpos($file, '\\');
            }
            $name = false !== $p ? substr($file, $p + 1) : $file;
        }
        if (!$is_utf8) {
            $desc = mb_convert_encoding($desc, 'UTF-8', mb_list_encodings());
        }
        if ('' == $mimetype) {
            $mimetype = mime_content_type($file);
            if ($mimetype === '' || $mimetype === '0' || $mimetype === false) {
                $mimetype = 'application/octet-stream';
            }
        }
        $mimetype = str_replace('/', '#2F', $mimetype);
        $this->files[] = ['file' => $file, 'name' => $name, 'desc' => $desc, 'relationship' => $relationship, 'subtype' => $mimetype];
    }
    /**
     * Open attachment panel on PDF.
     */
    public function open_attachment_pane(): void
    {
        $this->open_attachment_pane = true;
    }
    /**
     * Add metadata description node.
     *
     * @param  string $description
     * The description of the metadata
     */
    public function add_metadata_description_node($description): void
    {
        $this->meta_data_descriptions[] = $description;
    }
    /**
     * Set PDF metadata infos.
     *
     * @param  array $metaDataInfos
     * The array with metadata information applied to the pdf
     */
    public function set_pdf_metadata_infos(array &$meta_data_infos): void
    {
        if ($this->deterministic_mode_enabled === true) {
            $meta_data_infos['createdDate'] = date('Y-m-d\TH:i:s', strtotime('2000-01-01 23:59:59'));
            $meta_data_infos['modifiedDate'] = date('Y-m-d\TH:i:s', strtotime('2000-01-01 23:59:59'));
        }
        $this->meta_data_infos = $meta_data_infos;
    }
    /**
     * Set the status of the deterministic mode. This mode should only be used
     * for testing purposes
     */
    public function set_deterministic_mode_enabled(bool $deterministic_mode_enabled): void
    {
        $this->deterministic_mode_enabled = $deterministic_mode_enabled;
    }
    /**
     * Put files.
     *
     *
     * @codingStandardsIgnoreStart
     */
    protected function _putfiles(): void
    {
        foreach ($this->files as &$info) {
            $this->put_file_specification($info);
            $info['file_index'] = $this->n;
            $this->put_file_stream($info);
        }
        $this->put_file_dictionary();
    }
    /**
     * Put file attachment specification.
     */
    protected function put_file_specification(array $file_info): void
    {
        $this->_newobj();
        $this->file_spec_dictionnary_index = $this->n;
        $this->_put('<<');
        $this->_put('/F (' . $this->_escape($file_info['name']) . ')');
        $this->_put('/Type /Filespec');
        $this->_put('/UF ' . $this->_textstring(mb_convert_encoding($file_info['name'], 'UTF-8', mb_list_encodings())));
        if ($file_info['relationship']) {
            $this->_put('/AFRelationship /' . $file_info['relationship']);
        }
        if ($file_info['desc']) {
            $this->_put('/Desc ' . $this->_textstring($file_info['desc']));
        }
        $this->_put('/EF <<');
        $this->_put('/F ' . ($this->n + 1) . ' 0 R');
        $this->_put('/UF ' . ($this->n + 1) . ' 0 R');
        $this->_put('>>');
        $this->_put('>>');
        $this->_put('endobj');
    }
    /**
     * Put file stream.
     */
    protected function put_file_stream(array $file_info): void
    {
        $this->_newobj();
        $this->_put('<<');
        $this->_put('/Filter /FlateDecode');
        if ($file_info['subtype']) {
            $this->_put('/Subtype /' . $file_info['subtype']);
        }
        $this->_put('/Type /EmbeddedFile');
        if (is_string($file_info['file']) && @is_file($file_info['file'])) {
            $fc = file_get_contents($file_info['file']);
        } else {
            $stream = $file_info['file']->get_stream();
            \fseek($stream, 0);
            $fc = stream_get_contents($stream);
        }
        if (false === $fc) {
            $this->Error('Cannot open file: ' . $file_info['file']);
        }
        if ($this->deterministic_mode_enabled === true) {
            $md = @date('YmdHis', strtotime('2000-01-01 23:59:59'));
        } elseif (is_string($file_info['file'])) {
            $md = @date('YmdHis', filemtime($file_info['file']));
        } else {
            $md = @date('YmdHis');
        }
        $fc = gzcompress($fc);
        $this->_put('/Length ' . strlen($fc));
        $this->_put(sprintf('/Params <</ModDate (D:%s)>>', $md));
        $this->_put('>>');
        $this->_putstream($fc);
        $this->_put('endobj');
    }
    /**
     * Put file dictionnary.
     */
    protected function put_file_dictionary(): void
    {
        $this->_newobj();
        $this->files_index = $this->n;
        $this->_put('<<');
        $s = '';
        $files = $this->files;
        usort($files, function (array $a, array $b): int {
            // Sorting files in name order as PDF specs (if not, issue with Acrobat Reader when trying to download attachments)
            return strcmp($a['name'], $b['name']);
        });
        foreach ($files as $info) {
            $s .= sprintf('%s %s 0 R ', $this->_textstring($info['name']), $info['file_index']);
        }
        $this->_put(sprintf('/Names [%s]', $s));
        $this->_put('>>');
        $this->_put('endobj');
    }
    /**
     * Put metadata descriptions.
     */
    protected function put_metadata_descriptions(): void
    {
        $s = '<?xpacket begin="" id="W5M0MpCehiHzreSzNTczkc9d"?>' . "\n";
        $s .= '<x:xmpmeta xmlns:x="adobe:ns:meta/">' . "\n";
        $s .= '<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">' . "\n";
        $this->_newobj();
        $this->description_index = $this->n;
        foreach ($this->meta_data_descriptions as $desc) {
            $s .= $desc . "\n";
        }
        $s .= '</rdf:RDF>' . "\n";
        $s .= '</x:xmpmeta>' . "\n";
        $s .= '<?xpacket end="w"?>';
        $this->_put('<<');
        $this->_put('/Length ' . strlen($s));
        $this->_put('/Type /Metadata');
        $this->_put('/Subtype /XML');
        $this->_put('>>');
        $this->_putstream($s);
        $this->_put('endobj');
    }
    /**
     * Put resources including files and metadata descriptions.
     *
     * @codingStandardsIgnoreStart
     */
    protected function _putresources(): void
    {
        parent::_putresources();
        if ($this->files !== []) {
            $this->_putfiles();
        }
        $this->_putoutputintent();
        if (!empty($this->meta_data_descriptions)) {
            $this->put_metadata_descriptions();
        }
    }
    /**
     * Put output intent with ICC profile.
     *
     * @codingStandardsIgnoreStart
     */
    protected function _putoutputintent(): void
    {
        $this->_newobj();
        $this->_put('<<');
        $this->_put('/Type /OutputIntent');
        $this->_put('/S /GTS_PDFA1');
        $this->_put('/OuputCondition (sRGB)');
        $this->_put('/OutputConditionIdentifier (Custom)');
        $this->_put('/DestOutputProfile ' . ($this->n + 1) . ' 0 R');
        $this->_put('/Info (sRGB V4 ICC)');
        $this->_put('>>');
        $this->_put('endobj');
        $this->output_intent_index = $this->n;
        $icc = file_get_contents(Zugferd_Settings::get_full_icc_profile_filename());
        $icc = gzcompress($icc);
        $this->_newobj();
        $this->_put('<<');
        $this->_put('/Length ' . strlen($icc));
        $this->_put('/N 3');
        $this->_put('/Filter /FlateDecode');
        $this->_put('>>');
        $this->_putstream($icc);
        $this->_put('endobj');
    }
    /**
     * Put catalog node, including associated files.
     *
     * @codingStandardsIgnoreStart
     */
    protected function _putcatalog(): void
    {
        parent::_putcatalog();
        if ($this->files !== []) {
            if (is_array($this->files)) {
                $files_ref_str = '';
                foreach ($this->files as $file) {
                    if ('' !== $files_ref_str) {
                        $files_ref_str .= ' ';
                    }
                    $files_ref_str .= sprintf('%s 0 R', $file['file_index']);
                }
                $this->_put(sprintf('/AF [%s]', $files_ref_str));
            } else {
                $this->_put(sprintf('/AF %s 0 R', $this->files_index));
            }
        }
        if (0 != $this->description_index) {
            $this->_put(sprintf('/Metadata %s 0 R', $this->description_index));
        }
        if ($this->files !== []) {
            $this->_put('/Names <<');
            $this->_put('/EmbeddedFiles ');
            $this->_put(sprintf('%s 0 R', $this->files_index));
            $this->_put('>>');
        }
        if (0 != $this->output_intent_index) {
            $this->_put(sprintf('/OutputIntents [%s 0 R]', $this->output_intent_index));
        }
        if ($this->open_attachment_pane) {
            $this->_put('/PageMode /UseAttachments');
        }
    }
    /**
     * Put trailer including ID.
     *
     * @codingStandardsIgnoreStart
     */
    protected function _puttrailer(): void
    {
        parent::_puttrailer();
        $created_id = md5($this->generate_metadata_string('created'));
        $modified_id = md5($this->generate_metadata_string('modified'));
        $this->_put(sprintf('/ID [<%s><%s>]', $created_id, $modified_id));
    }
    /**
     * Put general information
     */
    protected function _putinfo(): void
    {
        if ($this->deterministic_mode_enabled === true) {
            $this->creation_date = strtotime('2000-01-01 23:59:59');
        }
        parent::_putinfo();
    }
    /**
     * Override for PDF-A/3 conformant links.
     *
     * This fixes the following issues:
     * - Fix 1: Annotation dictionaries need /F and should be printable => /F 4
     * - Fix 2: Ensure our PDF/A-compliant /F stays effective and avoid duplicate /F keys
     *
     * @param  int  $n
     * @return void
     */
    protected function _putlinks($n)
    {
        foreach ($this->page_links[$n] as $pl) {
            $this->_newobj();
            $rect = sprintf('%.2F %.2F %.2F %.2F', $pl[0], $pl[1], $pl[0] + $pl[2], $pl[1] - $pl[3]);
            $this->_put('<</Type /Annot /Subtype /Link /Rect [' . $rect . '] /F 4', false);
            // Fix 1
            if (is_string($pl[4])) {
                if (isset($pl['importedLink'])) {
                    $this->_put('/A <</S /URI /URI (' . $this->_escape($pl[4]) . ')>>');
                    $values = $pl['importedLink']['pdfObject']->value;
                    foreach ($values as $name => $entry) {
                        if ('F' === $name) {
                            // Fix 2
                            continue;
                        }
                        $this->_put('/' . $name . ' ', false);
                        $this->write_pdf_type($entry);
                    }
                    if (isset($pl['quadPoints'])) {
                        $s = '/QuadPoints[';
                        foreach ($pl['quadPoints'] as $value) {
                            $s .= sprintf('%.2F ', $value);
                        }
                        $s .= ']';
                        $this->_put($s);
                    }
                } else {
                    $this->_put('/A <</S /URI /URI ' . $this->_textstring($pl[4]) . '>>');
                    $this->_put('/Border [0 0 0]', false);
                }
                $this->_put('>>');
            } else {
                $this->_put('/Border [0 0 0] ', false);
                $l = $this->links[$pl[4]];
                if (isset($this->page_info[$l[0]]['size'])) {
                    $h = $this->page_info[$l[0]]['size'][1];
                } else {
                    $h = 'P' === $this->def_orientation ? $this->def_page_size[1] * $this->k : $this->def_page_size[0] * $this->k;
                }
                $this->_put(sprintf('/Dest [%d 0 R /XYZ 0 %.2F null]>>', $this->page_info[$l[0]]['n'], $h - $l[1] * $this->k));
            }
            $this->_put('endobj');
        }
    }
    /**
     * Generate metadata string.
     *
     * @param string|null $dateType
     * The type of the metadata date
     * @return string
     * @codingStandardsIgnoreStart
     */
    protected function generate_metadata_string(?string $date_type = null)
    {
        $date_type = $date_type ?? 'created';
        $meta_data_string = '';
        if (isset($this->meta_data_infos['title'])) {
            $meta_data_string .= $this->meta_data_infos['title'];
        }
        if (isset($this->meta_data_infos['subject'])) {
            $meta_data_string .= $this->meta_data_infos['subject'];
        }
        if ($date_type === 'modified' && isset($this->meta_data_infos['modifiedDate'])) {
            $meta_data_string .= $this->meta_data_infos['modifiedDate'];
        }
        if ($date_type === 'created' && isset($this->meta_data_infos['createdDate'])) {
            $meta_data_string .= $this->meta_data_infos['createdDate'];
        }
        return $meta_data_string;
    }
}
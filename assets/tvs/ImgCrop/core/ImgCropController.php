<?php namespace ImgCrop;

include_once(MODX_BASE_PATH . 'assets/snippets/DocLister/lib/DLTemplate.class.php');
include_once (MODX_BASE_PATH . 'assets/lib/Helpers/FS.php');
include_once (MODX_BASE_PATH . 'assets/lib/Helpers/Assets.php');
class ImgCropController
{
    protected $modx = null;
    protected $DLTemplate = null;
    protected $row = array();
    protected $assets = null;
    protected $fs = null;
    protected $templatePath = 'assets/tvs/ImgCrop/tpl/';
    protected $jsListDefault = 'assets/tvs/ImgCrop/js/scripts.json';
    protected $cssListDefault = 'assets/tvs/ImgCrop/css/scripts.json';
    public function __construct($modx, $row)
    {
        $this->row = $row;
        $this->DLTemplate = \DLTemplate::getInstance($modx);
        $this->assets = \AssetsHelper::getInstance($modx);
        $this->fs = \Helpers\FS::getInstance();
        $this->modx = $modx;
    }
    public function prerender(){
        $data = array();
        $data['id'] = $this->row['id'];
        $data['value'] = $this->row['value'];
        $data['aspectratio'] = $this->modx->parseProperties($this->row['properties'])['aspectratio'];
        $data['bgcolor'] = $this->modx->parseProperties($this->row['properties'])['bgcolor'] ?? '#000';
        $data['format'] = $this->modx->parseProperties($this->row['properties'])['format'] ?? 'jpg';
        return $data;
    }
    public function loadAssets($file,$ph = array()) {
        $output = '';
        $scripts = MODX_BASE_PATH.$file;
        if($this->fs->checkFile($scripts)) {
            $scripts = @file_get_contents($scripts);
            $scripts = $this->DLTemplate->parseChunk('@CODE:'.$scripts,$ph);
            $scripts = json_decode($scripts,true);
            if ($scripts) {
                $output = $this->assets->registerScriptsList($scripts);
            }
        }
        return $output;
    }

    public function render() {
        $data = $this->prerender();
        $data['js'] = $this->loadAssets($this->jsListDefault);
        $data['css'] = $this->loadAssets($this->cssListDefault);
        $this->DLTemplate->setTemplatePath($this->templatePath);
        $output = $this->DLTemplate->parseChunk('@B_FILE:imgCrop', $data);

        return $output;
    }
}

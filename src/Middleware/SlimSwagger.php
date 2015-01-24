<?php
namespace terwey;

class SlimSwagger extends \Slim\Middleware
{
    /**
     * @var array
     */
    protected $swaggerOptions;
    protected $options;

    /**
     * Constructor
     * @param array $settings
     */
    public function __construct($swaggerSettings = array(), $options = array())
    {
        $defaults = array(
            'output' => 'json',
            //'apiVersion' => $defaultApiVersion,
            //'swaggerVersion' => $defaultSwaggerVersion,
            //'defaultSwaggerVersion' => $resourceList['swaggerVersion'],
            //'defaultBasePath' => $defaultBasePath
        );
        $defaultOptions = array(
            'baseDir' => __DIR__.'/../',
            'ignoreDir' => array()
        );
        $this->swaggerOptions = array_merge($defaults, $swaggerSettings);
        $this->options = array_merge($defaultOptions, $options);
    }

    /**
     * Call
     */
    public function call()
    {
        $this->app->get('/api-docs', array($this, 'apiDocs'))->name('apiDocs');
        $this->app->get('/api-docs/:resource', array($this, 'apiDocsForResource'))->name('apiDocsForResource');
        $this->app->get('/docs/', array($this, 'docsView'))->name('apiView');
        $this->next->call();
    }

    public function apiDocs()
    {
        $this->app->contentType("application/json");
        $swagger = new \Swagger\Swagger($this->options['baseDir'], $this->options['ignoreDir']);
        $resourceList = $swagger->getResourceList($this->swaggerOptions);
        
        echo $resourceList;
        
    }

    public function apiDocsForResource($resource, $level1 = '', $level2 = '', $level3 = '')
    {
        $this->app->contentType("application/json");
        $swagger = new \Swagger\Swagger($this->options['baseDir'], $this->options['ignoreDir']);
        $resource = '/'.str_replace('-', '/', $resource);
        echo $swagger->getResource($resource, $this->swaggerOptions);
    }

    public function docsView()
    {
        $this->app->render('swagger-ui.twig');
    }
}

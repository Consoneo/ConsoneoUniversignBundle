ConsoneoUniversignBundle
========================

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/64d0ec33-f69c-4678-a796-cbf7011ee352/mini.png)](https://insight.sensiolabs.com/projects/64d0ec33-f69c-4678-a796-cbf7011ee352)

Installation
-------------------------

To install ConsoneoUniversignBundle with Composer just add the following to your 'composer.json' file:

    {
        require: {
            "consoneo/universign-bundle": "*",
            ...
        }
    }

The next thing you should do is install the bundle by executing the following command:

    php composer.phar update consoneo/universign-bundle
    
Finally, add the bundle to the registerBundles function of the AppKernel class in the 'app/AppKernel.php' file:

    public function registerBundles()
    {
        $bundles = array(
            ...
            new Consoneo\Bundle\UniversignBundle\ConsoneoUniversignBundle(),
            ...
        );
        
Configuration
-------------------------

Configure the bundle by adding the following to app/config/config.yml' with your own configuration:

    consoneo_universign:
        horodatage:
            login:              xxx
            password:             xxx
    
Horodatage
----------
For access to universign horodatage service :

    $this->container->get('universign.horodatage');
    
Universign Horodatage support following methods :

* **postPdf** (Accès suivant le procotole XML-RPC) Horodater un fichier PDF diffère de l’horodatage de fichiers
courants car le sceau d’horodatage est embarqué dans le fichier PDF.
Lors de l’opération d’horodatage, le document PDF source doit être transmis intégralement afin
d’y apposer le jeton d’horodatage.


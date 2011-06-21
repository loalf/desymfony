<?php

namespace Desymfony\DesymfonyBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Charla4Command extends Command
{
    protected function configure()
    {
        $this
            ->setName('desymfony:regresion:charla4')
            ->setDescription('Regresión a la charla 4, formularios y seguridad')
            ->setHelp(<<<EOT
Elimina, añade o modifica todos los archivos necesarios para poder reproducir
el tutorial de la charla 4.
EOT
                    );
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filesystem = $this->container->get('filesystem');
        $bundle_dir = $this->container->get('kernel')->getBundle('DesymfonyBundle')->getPath();

        $output->writeln($bundle_dir);

        /* Eliminar archivos que no nos son válidos */
        $eliminados = array(
           '/Controller/UsuarioController.php',
           '/Entity/Usuario.php',
           '/Resources/config/usuario_routing.yml',
           '/Resources/views/Usuario/denegado.html.twig',
           '/Resources/views/Usuario/login.html.twig',
           '/Resources/views/Usuario/perfil.html.twig',
           '/Resources/views/Usuario/registro.html.twig'
        );

        $output->writeln('<info>Borrando de archivos</info>');
        foreach($eliminados as $eliminado){
            $archivo = $bundle_dir.$eliminado;
            if(file_exists($archivo) && !is_dir($archivo)){
              $output->writeln(sprintf(" > Eliminando archivo <comment>%s</comment>", $eliminado));
              //$filesystem->remove($bundle_dir.$archivo);
            }
        }
        $output->writeln('');

        /* Reemplazar archivos por sus versiones pasadas */
        $pasados = array(
          '/Entity/Usuario.php'
        );

        $output->writeln('<info>Copiando archivos en forma pasada</info>');
        foreach($pasados as $pasado){
            $archivo_a = $bundle_dir.'/charla4_skeleton/'.$pasado;
            $archivo_b = $bundle_dir.$pasado;
            //$filesystem->copy($archivo_a, $archivo_b);
            $output->writeln(sprintf(" > Copiado archivo <comment>%s</comment>", $pasado));
        }
        
    }


}
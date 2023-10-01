<?php

///////////////// Traits ////////////////////////////////

trait DispositivoInformatico{
    
    protected bool $encendida = false;
    
    public function encender()
    {
        if (! $this->encendida) {
            $this->encendida = true;
            echo "Encendio correctamente";
            echo "<br>";
        } else {
            echo "Ya esta encendida";
            echo "<br>";
        }
    }
    
    public function apagar()
    {
        if ($this->encendida) {
            $this->encendida = false;
            echo "Se ha apagado correctamente. \n";
            echo "<br>";
        } else {
            echo "Ya está apagada. \n";
            echo "<br>";
        }
    }
    
}
trait ConsolaDeJuego
{
    use DispositivoInformatico;
    protected String $juegoActual = ''; 
    protected Array $juegosDisponibles;

    public function abrirJuego(int $indiceJuego)
    {
        if($this->encendida){
            if ($this->juegoActual == '') {
                if ($indiceJuego >= 0 && $indiceJuego < sizeof($this->juegosDisponibles)) {
                    $this->juegoActual = $this->juegosDisponibles[$indiceJuego];
                    echo "Juego " . $this->juegoActual . " abierto.\n";
                    echo "<br>";
                } else {
                    echo "Índice de juego inválido.\n";
                    echo "<br>";
                }
            } else {
                echo "Ya hay un juego en ejecución: " . $this->juegoActual . "\n";
                echo "<br>";
            }
        }
        else
            echo "El dispositivo esta apagado.";
    }

    public function cerrarJuego()
    {
            if ($this->juegoActual != '') {
                echo "Juego " . $this->juegoActual . " cerrado.\n";
                echo "<br>";
                $this->juegoActual = '';
            } else {
                echo "No hay ningún juego en ejecución para cerrar.\n";
                echo "<br>";
            }
    }

    public function jugar()
    {
        if($this->encendida){
    		if ($this->juegoActual != '') {
                echo "Jugando " . $this->juegoActual . "...";
                echo "<br>";
            } else {
                echo "No hay ningún juego abierto para jugar.";
                echo "<br>";
            }
		}
		else
			echo "El dispositivo esta apagado.";
    }

    public function listarJuegos()
    {
		if($this->encendida){
            $i = 0;
            echo "Juegos disponibles en la consola:";
            echo "<br>";
                for ($i; $i < sizeof($this->juegosDisponibles); $i ++) {
                    echo " [ " . $i + 1 . " ] " . $this->juegosDisponibles[$i] . " ";
                    echo "<br>";
                }
        	}
		else
			echo "El dispositivo esta apagado.";
	}
}

trait DispositivoTactilPortatil
{
    protected int $brillo;
    protected int $bateria;
    protected String $portapapeles = '';
	use DispositivoInformatico;
	
	// REDEFINO METODO HOMONIMO
	// EL DEFINIDO AQUI TIENE PRIORIDAD RESPECTO AL QUE ESTA EN EL TRAIT DispositivoInformatico
    public function encender()
    {
        if (! $this->encendida) {
            $this->encendida = true;
            echo "El dispositivo portatil  encendio correctamente";
            echo "<br>";
        } else {
            echo "El dispositivo portatil ya esta encendido";
            echo "<br>";
        }
	}		

    public function apagar()
    {
        if ($this->encendida) {
            $this->encendida = false;
            echo "El dispositivo portatil  se ha apagado correctamente. \n";
            echo "<br>";
        } else {
            echo "El dispositivo portatil  ya está apagado. \n";
            echo "<br>";
        }
    }

    public function copiar(string $texto)
    {
        if($this->encendida){
            $this->portapapeles = $texto;    
            echo "Texto copiado al portapapeles";
            echo "<br>";
        }
        else
            echo "El dispositivo esta apagado";
    }

    public function pegar()
    {
        if($this->encendida){
            if (! $this->portapapeles == '') {
                echo "Texto pegado desde el portapapeles: " . $this->portapapeles;
                echo "<br>";
            } else {
                echo "El portapapeles está vacío.";
                echo "<br>";
            }
        }
        else
            echo "El dispositivo esta apagado";
    }

    public function subirBrillo(int $cantidad)
    {
        if($this->encendida){
            if ($this->brillo + $cantidad <= 100) {
                $this->brillo += $cantidad;
                echo "Brillo aumentado a " . $this->brillo . " %.";
                echo "<br>";
            } else {
                $this->brillo = 100;
                echo "El brillo ha sido ajustado al máximo (100%).";
                echo "<br>";
            }
        }
        else 
            echo "El dispositivo esta apagado";
    }

    public function disminuirBrillo(int $cantidad)
    {
        if($this->encendida){
            if ($this->brillo - $cantidad >= 0) {
                $this->brillo -= $cantidad;
                echo "Brillo disminuido a " . $this->brillo . " %.";
                echo "<br>";
            } else {
                $this->brillo = 0;
                echo "El brillo ha sido ajustado al mínimo (0 %).";
                echo "<br>";
            }
        }
        else
            echo "El dispositivo esta apagado";
    }
    
    public function mostrarBateria()
    {
        if($this->encendida){
            echo "Batería actual: " . $this->bateria . " %.";
            echo "<br>";
        }
        else
            echo "El dispositivo esta apagado";
    } 
}


//Definimos el trait BateriaTablet con el objetivo de mostrar la precedencia en herencia
trait BateriaTablet{
    public function mostrarBateria(){
        if($this->encendida){
            echo "Batería actual de la TABLETA: " . $this->bateria . " %.";
            echo "<br>";
        }
        else
            echo "El dispositivo esta apagado";
    }
}

// ///////////////////////////////////////////FIN TRAITS////////////////////////////////////////////////////////////

// ////////////////////////////////////////////   CLASES   ///////////////////////////////////////////////////////////
// La clases hacen propios todos los metodos definidos en los traits 

//Definimos 2 clases abstractas con el unico objetivo de luego mostrar la herencia simple de php
abstract class Consola{
	use ConsolaDeJuego; 
}

abstract class DispositivoPortatil{
	use DispositivoTactilPortatil;
	
}

class NintendoSwitch
{
    private String $cartuchoInsertado ='';
    
    use ConsolaDeJuego,DispositivoTactilPortatil{
        ConsolaDeJuego::encender insteadof DispositivoTactilPortatil;  //debo determinar que voy a usar el metodo encender y apagar del trait ConsolaDeJuego en esta clase NintendoSwitch
        ConsolaDeJuego::apagar insteadof DispositivoTactilPortatil;          
        DispositivoTactilPortatil::apagar as ApagaTactil;              //si quisiera utilizar el metodo apagar de DispositivoTactilPortatil lo puedo aleasear
    }
    
    // La clase que haga uso de traits no debe definir una propiedad que tenga el mismo nombre que la que fue
    //definida dentro del contexto del trait
    // Exceptuando que su modificador de acceso sea el mismo así como el valor asignado
    
    public function __construct()
    {
        $this->juegosDisponibles = array(
            'Super Mario',
            'Zelda: Tears of the Kingdom',
            'Mario Kart 8',
            'Animal Crossing: New Horizons'
        );
        $this->bateria=100;
        $this->brillo=50;
    }
    
    public function insertarCartucho(String $inserta){
        if($this->encedida)
        {
            if(isnull($inserta)or $inserta=='')
                echo "Juego no valido";
                else
                {
                    $this->cartuchoInsertado=$nombre;
                    echo "Disco de" .  $this->cartuchoInsertado . "leido correctamente";
                }
        }
        else
            echo "El dispositivo esta apagado";
    }
    
}

class PlayStation5 extends Consola            //hereda todos los metodos de Consola y de sus traits
{

    private String $discoInsertado;
    
    public function __construct()
    {
        $this->juegosDisponibles = array(
            'GTA V',
            'FIFA 2023',
            'PES 2022',
            'Call of duty'
        );
    }
    public function insertarDisco(String $inserta){
        if($this->encedida)
        {
            if(isnull($inserta)or $inserta=='')
                echo "Juego no valido";
            else
            {
                $this->discoInsertado=$nombre;
                echo "Disco de" .  $this->discoInsertado . "leido correctamente";
            }
        }
        else
            echo "El dispositivo esta apagado";
        }   
    }

class iPad extends DispositivoPortatil
{           
    private Array $aplicacionesInstaladas;
    
    use BateriaTablet;   //el metodo mostrarBateria de este Trait va a sobreescribir al heredado 
    
    public function __construct()
    {
        $this->aplicacionesInstaladas = array(
            'Word',
            'Instagram',
            'TikTok',
            'Excel'
        );
		$this->bateria=100;
        $this->brillo=50;
    } 
    
    
    public function abrirAplicacion(int $indiceApp)
    {
        if ($indiceApp >= 0 && $indiceApp < sizeof($this->aplicacionesInstaladas)) {
            $this->appActual = $this->aplicacionesInstaladas[$indiceApp];
            echo "App " . $this->appActual . " abierta correctamente.\n";
            echo "<br>";
            if ($this->bateria < $this->bateria - 5) {
                echo "bateria baja apagando....";
                $this->apagar();
            } else
                $this->bateria -= 5;
        } else {
            echo "Índice de app inválido.\n";
            echo "<br>";
        }
    }

    public function listarApps()
    {
        $i = 0;
        echo "Apps disponibles en el dispositivo:";
        echo "<br>";
        for ($i; $i < sizeof($this->aplicacionesInstaladas); $i ++) {
            echo " [ " . $i + 1 . " ] " . $this->aplicacionesInstaladas[$i] . " ";
            echo "<br>";
        }
    }
}


// ///////////////////////////////////////FIN CLASES////////////////////////////////////////////////////////

// ///////////////////////////////// MAIN /////////////////////

$Nintendo = new NintendoSwitch();

$Nintendo->encender();

$Nintendo->apagar();

$Nintendo->encender();

$Nintendo->abrirJuego(1);

$Nintendo->jugar();

$Nintendo->cerrarJuego();

$Nintendo->jugar();

$Nintendo->listarJuegos();

$Nintendo->copiar("Juancito");

$Nintendo->pegar();

$Nintendo->disminuirBrillo(30);

$Nintendo->subirBrillo(25);

$Nintendo->mostrarBateria();

// ////////////////PRUEBO PLAYSTATION //////////////////////////////////////////////////////////////////

$Play5 = new PlayStation5();

$Play5->encender();

$Play5->apagar();

$Play5->encender();

$Play5->abrirJuego(1);

$Play5->jugar();

$Play5->cerrarJuego();

$Play5->jugar();

$Play5->listarJuegos();

// /////////////////////////// PRUEBO IPAD/////////////////////////////////////////////

$ipad = new iPad();

$ipad->encender();

$ipad->apagar();

$ipad->encender();

$ipad->abrirAplicacion(3);

$ipad->listarApps();

$ipad->copiar("Pedrito en ipad");

$ipad->pegar();

$ipad->disminuirBrillo(22);

$ipad->subirBrillo(25);

$ipad->mostrarBateria();

$ipad->apagar();


?>

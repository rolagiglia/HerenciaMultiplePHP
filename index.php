<?php
    
/////////////////                Traits        ////////////////////////////////

trait ConsolaDeJuego
{
    public function encender(){
        if (!$this->encendida) {
            $this->encendida = true;
            echo "La consola de juegos " . $this->nombre . ' encendio correctamente';
            echo "<br>";
        } else {
            echo "La consola de juegos " . $this->nombre . ' ya esta encendida';
            echo "<br>";
        }
    }
    
    public function apagar(){
        if ($this->encendida) {
            $this->encendida = false;
            echo "La consola de juegos " . $this->nombre . " se ha apagado correctamente. \n";
            echo "<br>";
        } else {
            echo  "La consola de juegos " .$this->nombre . " ya está apagada. \n";
            echo "<br>";
        }
    }
    public function abrirJuego(int $indiceJuego) {
        if ($this->juegoActual=='') {
            if ($indiceJuego >= 0 && $indiceJuego < sizeof($this->juegosDisponibles)) {
                $this->juegoActual = $this->juegosDisponibles[$indiceJuego];
                echo "Juego " . $this->juegoActual . " abierto.\n";
                echo "<br>";
            } else {
                echo "Índice de juego inválido.\n";
                echo "<br>";
            }
        } else {
            echo "Ya hay un juego en ejecución: " . $this->juegoActual. "\n";
            echo "<br>";
        }
    }
    
   
    public function cerrarJuego() {
        if ($this->juegoActual != '') {
            echo "Juego " . $this->juegoActual . " cerrado.\n";
            echo "<br>";
            $this->juegoActual='';
        } else {
            echo "No hay ningún juego en ejecución para cerrar.\n";
            echo "<br>";
        }
    }
    public function jugar() {
        if ($this->juegoActual != '') {
            echo "Jugando " . $this->juegoActual . "...";
            echo "<br>";
            
        } else {
            echo "No hay ningún juego abierto para jugar.";
            echo "<br>";
        }
    }
    
    public function listarJuegos() {
        $i=0;
        echo "Juegos disponibles en la consola:";
        echo "<br>";
        for($i;$i<sizeof($this->juegosDisponibles);$i++){
            echo " [ ". $i+1 . " ] " . $this->juegosDisponibles[$i]." ";
            echo "<br>";
        }
        
     }
    
}


trait DispositivoTactilPortatil{
    
    public function encender(){
        if (!$this->encendida) {
            $this->encendida = true;
            echo "El dispositivo portatil " . $this->nombre . ' encendio correctamente';
            echo "<br>";
        } else {
            echo "El dispositivo portatil" . $this->nombre . ' ya esta encendido';
            echo "<br>";
        }
    }
    
    public function apagar(){
        if ($this->encendida) {
            $this->encendida = false;
            echo "El dispositivo portatil " . $this->nombre . " se ha apagado correctamente. \n";
            echo "<br>";
        } else {
            echo  "El dispositivo portatil " .$this->nombre . " ya está apagado. \n";
            echo "<br>";
        }
    }
    
    public function copiar(string $texto){
       
            $this->portapapeles = $texto;
            
            echo "Texto copiado al portapapeles de ". $this->nombre ;
            echo "<br>";
        
    }
   
    public function pegar() {
        if (!$this->portapapeles=='') {
            echo "Texto pegado desde el portapapeles: " . $this->portapapeles;
            echo "<br>";
        } else {
            echo "El portapapeles está vacío.";
            echo "<br>";
        }
    }
    
    public function subirBrillo(int $cantidad) {
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
    
    
    public function disminuirBrillo(int $cantidad) {
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

    public function mostrarBateria() {
        echo "Batería actual: " . $this->bateria . " %.";
        echo "<br>";
    }
    
    
    
    
    
    
    
    /*
    // A partir de Java 8 las interfaces pueden tomar metodos por defecto, ejemplo:
    default void mostrarInfo() {
        System.out.println("Este es un dispositivo táctil portátil.");
    }*/
    
}
/////////////////////////////////////////////FIN TRAITS////////////////////////////////////////////////////////////


/////////////////////////////////////////////////CLASES///////////////////////////////////////////////////////////
//La clase NintendoSwitch hace propias todas las funciones definidas en el trait ConsolaDeJuego y DispositivoTactilPortatil como si estuvieran codeadas en la misma clase

class NintendoSwitch
{
    protected string $nombre;
    protected int $brillo = 50;
    protected String $juegoActual='';
    protected bool $encendida = false;
    protected int $bateria = 100;
    protected String $portapapeles = '';
    
    protected Array $juegosDisponibles;
    
    use ConsolaDeJuego,DispositivoTactilPortatil{
        ConsolaDeJuego::encender insteadof DispositivoTactilPortatil;  //debo determinar que voy a usar la funcion encender y apagar del trait ConsolaDeJuego en esta clase NintendoSwitch
        ConsolaDeJuego::apagar insteadof DispositivoTactilPortatil;    //si no le digo cual usar tira error        
    }
    
    public function __construct(){
       $this->juegosDisponibles=array('Super Mario','Zelda: Tears of the Kingdom','Mario Kart 8','Animal Crossing: New Horizons');
       $this->nombre = "NintendoSwitch";
    }
    
 
}

class PlayStation5
{
    private string $nombre;
    private String $juegoActual='';
    private bool $encendida = false;    
    private Array $juegosDisponibles;
    
    use ConsolaDeJuego;
    
    public function __construct(){
        $this->juegosDisponibles=array('GTA V','FIFA 2023','PES 2022','Call of duty');
        $this->nombre = "Playstation 5";
    }
    
}

class iPad
{
    private string $nombre;
    private int $brillo = 50;
    private bool $encendida = false;
    private int $bateria = 100;
    private String $portapapeles = '';
    private Array $appDisponibles;
    
    use DispositivoTactilPortatil;
    
    public function __construct(){
        $this->appDisponibles=array('Word','Instagram','TikTok','Excel');
        $this->nombre = "iPad";
    }
    
    public function abrirApp(int $indiceApp) {
        
            if ($indiceApp >= 0 && $indiceApp < sizeof($this->appDisponibles)) {
                $this->appActual = $this->appDisponibles[$indiceApp];
                echo "App " . $this->appActual . " abierta correctamente.\n";
                echo "<br>";
                if($this->bateria < $this->bateria-5){
                    echo "bateria baja apagando....";
                    $this->apagar();
                }else
                    $this->bateria-=5;
            } else {
                echo "Índice de app inválido.\n";
                echo "<br>";
            }
        }
        
        
    public function listarApps() {
        $i=0;
        echo "Apps disponibles en el dispositivo:";
        echo "<br>";
        for($i;$i<sizeof($this->appDisponibles);$i++){
            echo " [ ". $i+1 . " ] " . $this->appDisponibles[$i]." ";
            echo "<br>";
        }
        
    }
}
//Para mostrar la herencia simple podemos definir un dispositivo hijo de NintendoSwitch, como por ejemplo una nueva version de la misma consola que va a utilizar todos los metodos del padre incluso los Traits

class NuevaNintendoSwitch extends NintendoSwitch{
        
    private bool $Graficos4kActivos = false;     //atributo de esta subclase
    
    public function __construct(){     //constructor de esta subclase
        $this->juegosDisponibles=array('Super Mario 2.0','Zelda: Tears of the Kingdom 2.0','Mario Kart X','Animal Crossing: New Horizons 2.0');
        $this->nombre = "NuevaNintendoSwitch";
    }
        
    public function setGraficos4k(string $act){
        if($act=="ON"){
            $this->Graficos4kActivos=true;
            echo "Graficos 4k activados";
            echo "<br>";
        }
        else{
            if($act=="OFF"){
                $this->Graficos4kActivos=false;
                echo "Graficos 4k desactivados";
                echo "<br>";
            }
        }
    }
    
}

/////////////////////////////////////////FIN CLASES////////////////////////////////////////////////////////




 ///////////////////////////////////                MAIN   /////////////////////  

    $Nintendo = new NintendoSwitch;
    
    $Nintendo->encender();
    
    $Nintendo->apagar();

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
    
    //////////////////PRUEBO PLAYSTATION //////////////////////////////////////////////////////////////////
    
    $Play5 = new PlayStation5;
    
    $Play5->encender();
    
    $Play5->apagar();
    
    $Play5->abrirJuego(1);
    
    $Play5->jugar();
    
    $Play5->cerrarJuego();
    
    $Play5->jugar();
    
    $Play5->listarJuegos();
    
    /////////////////////////////  PRUEBO IPAD/////////////////////////////////////////////
    
    $ipad = new iPad;
    
    $ipad->encender();
    
    $ipad->apagar();
    
    $ipad->abrirApp(3);
    
    
    $ipad->listarApps();
    
    
    $ipad->copiar("Pedrito en ipad");
    
    $ipad->pegar();
    
    $ipad->disminuirBrillo(22);
    
    $ipad->subirBrillo(25);
    
    $ipad->mostrarBateria();
    
   
    
    ///PRUEBO CONSOLA NUEVA//////////////////////////////////////////////////////////////////////////////////
    
    $NuevaNintendo = new NuevaNintendoSwitch;
    
    $NuevaNintendo->encender();
    
    $NuevaNintendo->apagar();
    
    $NuevaNintendo->abrirJuego(1);
    
    $NuevaNintendo->jugar();
    
    $NuevaNintendo->cerrarJuego();
    
    $NuevaNintendo->jugar();
    
    $NuevaNintendo->listarJuegos();
    
    
    $NuevaNintendo->copiar("Pedrito");
    
    $NuevaNintendo->pegar();
    
    $NuevaNintendo->disminuirBrillo(30);
    
    $NuevaNintendo->subirBrillo(25);
    
    $NuevaNintendo->mostrarBateria();
    
    $NuevaNintendo->setGraficos4k('ON');
    
    $NuevaNintendo->setGraficos4k('OFF');
?>

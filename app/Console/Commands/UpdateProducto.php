<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Producto;
use App\Categoria;
use Illuminate\Support\Facades\DB;

class UpdateProducto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actualizar:producto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza inventarios, precios, cambio de divisa e imagen de los productos existentes; y añade productos inexistentes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->ActualizarProductos();
    }
     public function CargarProducto($datos)
    {

        $producto=new Producto();
        for ($c=0; $c < 27; $c++) {
            
            switch ($c) {
                case 0:
                        $data=DB::connection()->getPdo()->quote(utf8_encode($datos[$c]));
                        $producto->modelo=substr($data,1,strlen($data)-2);
                    break;
                case 1:
                        $data=DB::connection()->getPdo()->quote(utf8_encode($datos[$c]));
                        $producto->marca=substr($data,1,strlen($data)-2);
                    break;
                case 2:
                        $data=DB::connection()->getPdo()->quote(utf8_encode($datos[$c]));
                        $producto->titulo=substr($data,1,strlen($data)-2);
                    break;
                case 5:
                        $producto->costoUSD=$datos[$c];
                        $producto->costoMXN=($datos[$c]*$datos[11]);
                        break;
                case 6:
                        $producto->inventario=$datos[$c];
                case 8:
                        $producto->peso=$datos[$c];
                    break;
                case 9:
                        $data=DB::connection()->getPdo()->quote(utf8_encode($datos[$c]));
                        $producto->descripcion=$data;
                    break;        
                case 10:
                        $producto->imagen=$datos[$c];
                    break; 
                case 12:
                        $categoria1=Categoria::where('nombre',$datos[$c])->get();
                        foreach ($categoria1 as $c1) {
                            foreach ($c1->hijos as $h) {
                                if($datos[$c+1]==$h->nombre || $datos[$c+2]==$h->nombre)
                                {
                                    if(isset($h->hijos) && $datos[$c+2]!='Todos' && $datos[$c+2]!='Todas' && $datos[$c+2]!='Ver Todas' && $datos[$c+2]!='Todo' && $datos[$c+2]!='---')
                                    {
                                        foreach ($h->hijos as $nieto) {
                                            if($datos[$c+2]==$nieto->nombre)
                                            {
                                                $producto->categoria_id=$nieto->id;
                                                break 3;
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $producto->categoria_id=$h->id;
                                        break 2;
                                    }   
                                }
                            }
                        }
                    break;
            }
        }
        $producto->save();
    }

    public function ActualizarProductos()
    {
        set_time_limit(300);
        $inicio=microtime(true);
        file_put_contents("data.csv", fopen("http://syscom.mx/principal/reporte_art_hora?cadena1=104511683&cadena2=ecab1f7d0a20621a021555208cf8b441&all=1&cadena3=1&alm=1&img=1&tc=1&ctg=8&sel=0", 'r'));
        $fila = 0;  
        if (($gestor = fopen("data.csv", "r")) !== FALSE)
        {
            while (($datos = fgetcsv($gestor)) !== FALSE)
            {
                $start = microtime(true);
                if($fila)
                {
                    
                    if($producto=Producto::where('modelo',utf8_encode($datos[0]))->first())
                    {
                        $producto->costoUSD=$datos[5];
                        if(strpos($producto->titulo, 'NVR')!== false || strpos($producto->titulo, 'DVR')!== false)
                        {
                            $producto->costoMXN=($datos[5]*$datos[11])*2;
                        }
                        else
                        {
                            $producto->costoMXN=($datos[5]*$datos[11])*1.3;
                        }
                        
                        $producto->inventario=$datos[6];
                        $producto->imagen=$datos[10];
                        $producto->update();
                        //echo 'fila '.$fila.' tardo '.(microtime(true)-$start).'<br>';
                        //dd(microtime(true)-$start);
                    }
                    else
                    {
                        $this->CargarProducto($datos);
                    }
                }
                $fila++;
            }
            writeOutputTo('Productos actualizados');
            //dd(microtime(true)-$inicio);
        }
        //return $this->index();
    }
}

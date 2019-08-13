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
        set_time_limit(300);
        $inicio=microtime(true);
        file_put_contents("data.csv", fopen("http://syscom.mx/principal/reporte_art_hora?cadena1=104511683&cadena2=ecab1f7d0a20621a021555208cf8b441&all=1&cadena3=1&alm=1&img=1&tc=1&ctg=8&sel=0", 'r'));
        if(Categoria::get()->count()==0)
        {
            $this->CargarCategorias();
        }
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
                        if(strpos($producto->titulo, 'NVR')!== false || strpos($producto->titulo, 'DVR')!== false)
                        {
                            $producto->costoMXN=(($datos[5]*$datos[11])*2)*1.16;
                        }
                        else
                        {
                            $producto->costoMXN=(($datos[5]*$datos[11])*1.3)*1.16;
                        }
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
                            $producto->costoMXN=(($datos[5]*$datos[11])*2)*1.16;
                        }
                        else
                        {
                            $producto->costoMXN=(($datos[5]*$datos[11])*1.3)*1.16;
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
            //writeOutputTo('Productos actualizados');
            //dd(microtime(true)-$inicio);
        }
        //return $this->index();
    }

     public function CargarCategorias()
    {
         set_time_limit(20000);
          //file_put_contents("data.csv", file_get_contents("http://syscom.mx/principal/reporte_art_hora?cadena1=104511683&cadena2=ecab1f7d0a20621a021555208cf8b441&all=1&cadena3=1&alm=1&img=1&tc=1&ctg=8&sel=0"));
        $fila = 0;
        //  if (($gestor = fopen("data.csv", "r")) !== FALSE) {
        //     while (($datos = fgetcsv($gestor)) !== FALSE) {
        //         $fila++;
        //         for($i=0;$i<15;$i++)
        //         {
        //             echo $i." ".$datos[$i]."<br>";
        //         }
        //         if($fila>0)
        //         {
        //             break;
        //         }
        //     }
        //     fclose($gestor);
        //     dd('Categorias cargadas exitosamente');
        // }
        
        $categorias['nivel']=[];
        if (($gestor = fopen("data.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor)) !== FALSE) {
                //echo $fila.'<br>';
                if($fila)
                {
                    for($i=12;$i<=14;$i++)
                    {
                        $verificar=1;
                        $categorias=Categoria::get();
                        foreach ($categorias as $c ) {
                            if($i==14 && ($datos[13]=='---' || $datos[13]=='Todos' || $datos[13]=='Todas' || $datos[13]=='Ver Todas' || $datos[13]=='Todo')) {
                                if(($c->nivel==2 && $c->nombre==$datos[$i] && $c->padre->nombre==$datos[$i-2]) || $datos[$i]=='---' || $datos[$i]=='Todos' || $datos[$i]=='Todas' || $datos[$i]=='Ver Todas' || $datos[$i]=='Todo')
                                {
                                    $verificar=0;
                                    break;
                                }
                            }
                            elseif ($i==14) {
                                if (($c->nivel==3 && $c->padre->nombre==$datos[$i-1] && $c->padre->padre->nombre==$datos[$i-2]) || $datos[$i]=='---' || $datos[$i]=='Todos' || $datos[$i]=='Todas' || $datos[$i]=='Ver Todas' || $datos[$i]=='Todo') {
                                    $verificar=0;
                                    break;
                                }
                            }
                            elseif($i==13)
                            {
                            
                                if(($c->nivel==2 && $c->nombre==$datos[$i] && ($c->padre->nombre==$datos[$i-1] || $c->padre->nombre==$datos[$i-2])) || $datos[$i]=='---' || $datos[$i]=='Todos' || $datos[$i]=='Todas' || $datos[$i]=='Ver Todas' || $datos[$i]=='Todo')
                                {
                                    $verificar=0;
                                    break;
                                }
                                
                                
                            }
                            else
                            {
                                if(($c->nombre==$datos[$i] || $datos[$i]=='---' || $datos[$i]=='Todos' || $datos[$i]=='Todas' || $datos[$i]=='Ver Todas') && $c->nivel==1)
                                {
                                    $verificar=0;
                                    break;
                                }
                            }

                                
                        }
                        if($verificar)
                        {
                            $categoria=new Categoria();
                            $categoria->nombre=$datos[$i];
                            $categoria->nivel=$i-11;
                            if($i==14 && ($datos[$i-1]=='---' || $datos[$i-1]=='Todos' || $datos[$i-1]=='Todas' || $datos[$i-1]=='Ver Todas' || $datos[$i-1]=='Todo'))
                            {
                                $padres=Categoria::where([['nombre',$datos[$i-2]],['nivel','<',2]])->get();
                                $categoria->nivel=2;
                                $categoria->categoria_padre=$padres->first()->id;
                                break;
                                     
                            }
                            elseif ($i==14) {
                                $padres=Categoria::where([['nombre',$datos[$i-1]],['nivel',2]])->get();
                                foreach ($padres as $padre) {
                                    // if(isset($padre->padre))
                                    // {
                                        if($padre->padre->nombre==$datos[$i-2])
                                        {
                                            $categoria->categoria_padre=$padre->id;
                                            break;
                                        }
                                   //  }
                                   //  else
                                   // {
                                   //      echo("informacion:<br>"."i=".$i);
                                   //      echo("<br>datos[$i]: ".$datos[$i]);
                                   //     dd($padre);
                                   // }

                                        
                                }
                            }
                            elseif($i==13)
                            {
                                $padre=Categoria::where([['nombre',$datos[$i-1]],['nivel','<',2]])->get();
                                $categoria->categoria_padre=$padre->first()->id;
                            }
                            $categoria->save();
                        }
                    }                        
                }
                $fila++;
                

                //echo $fila.'<br>';
                // if($fila==3000)
                //     break;

            }
            fclose($gestor);
            //dd('Categorias cargadas exitosamente');
        }

    }
}

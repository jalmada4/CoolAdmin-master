<?php 
    require "config/database.php";

    if(empty($_SESSION['username']) && empty($_SESSION['password'])){
        echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    }
    else{
        if($_GET['module'] =='start'){
            include "modules/start/view.php";
        }

        elseif($_GET['module']=='password'){
            include "modules/password/view.php";
        }

        elseif($_GET['module']=='user'){
            include "modules/user/view.php";
        }
        elseif($_GET['module']=='form_user'){
            include "modules/user/form.php";
        }
        
        elseif($_GET['module']=='perfil'){
            include "modules/perfil/view.php";
        }
        elseif($_GET['module']=='form_perfil'){
            include "modules/perfil/form.php";
        } 

        elseif($_GET['module']=='departamento'){
            include "modules/departamento/view.php";
        }
        elseif($_GET['module']=='form_departamento'){
            include "modules/departamento/form.php";
        } 

        elseif($_GET['module']=='ciudad'){
            include "modules/ciudad/view.php";
        }
        elseif($_GET['module']=='form_ciudad'){
            include "modules/ciudad/form.php";
        } 

        elseif($_GET['module']=='clientes'){
            include "modules/clientes/view.php";
        }
        elseif($_GET['module']=='form_clientes'){
            include "modules/clientes/form.php";
        } 
    	
        elseif($_GET['module']=='compras'){
            include "modules/compras/view.php";
        }
        elseif($_GET['module']=='form_compras'){
            include "modules/compras/form.php";
        } 

        elseif($_GET['module']=='stock'){
            include "modules/stock/view.php";
        }

        elseif($_GET['module']=='deposito'){
            include "modules/deposito/view.php";
        }
        elseif($_GET['module']=='form_deposito'){
            include "modules/deposito/form.php";
        }

        elseif($_GET['module']=='tipo_producto'){
            include "modules/tipo_producto/view.php";
        }
        elseif($_GET['module']=='form_tipo_producto'){
            include "modules/tipo_producto/form.php";
        } 

        elseif($_GET['module']=='proveedor'){
            include "modules/proveedor/view.php";
        }
        elseif($_GET['module']=='form_proveedor'){
            include "modules/proveedor/form.php";
        }

        elseif($_GET['module']=='umedida'){
            include "modules/umedida/view.php";
        }
        elseif($_GET['module']=='form_umedida'){
            include "modules/umedida/form.php";
        }

        elseif($_GET['module']=='producto'){
            include "modules/producto/view.php";
        }
        elseif($_GET['module']=='form_producto'){
            include "modules/producto/form.php";
        }

        elseif($_GET['module']=='ventas'){
            include "modules/ventas/view.php";
        }
        elseif($_GET['module']=='form_ventas'){
            include "modules/ventas/form.php";
        }

        elseif($_GET['module']=='pedidos'){
            include "modules/pedidos/view.php";
        }
        elseif($_GET['module']=='form_pedidos'){
            include "modules/pedidos/form.php";
        }

        elseif($_GET['module']=='presupuesto'){
            include "modules/presupuesto/view.php";
        }
        elseif($_GET['module']=='form_presupuesto'){
            include "modules/presupuesto/form.php";
        }

        elseif($_GET['module']=='orden'){
            include "modules/orden/view.php";
        }
        elseif($_GET['module']=='form_orden'){
            include "modules/orden/form.php";
        }

        elseif($_GET['module']=='caja_apertura_cierre'){
            include "modules/caja_apertura_cierre/view.php";
        }
        elseif($_GET['module']=='form_caja_apertura_cierre'){
            include "modules/caja_apertura_cierre/form.php";
        }

        elseif($_GET['module']=='nota_remision'){
            include "modules/nota_remision/view.php";
        }
        elseif($_GET['module']=='form_nota_remision'){
            include "modules/nota_remision/form.php";
        }

        elseif($_GET['module']=='caja'){
            include "modules/caja/view.php";
        }
        elseif($_GET['module']=='form_caja'){
            include "modules/caja/form.php";
        }

        elseif($_GET['module']=='marca'){
            include "modules/marca/view.php";
        }
        elseif($_GET['module']=='form_marca'){
            include "modules/marca/form.php";
        }

        elseif($_GET['module']=='modelo'){
            include "modules/modelo/view.php";
        }
        elseif($_GET['module']=='form_modelo'){
            include "modules/modelo/form.php";
        }

        elseif($_GET['module']=='movil'){
            include "modules/movil/view.php";
        }
        elseif($_GET['module']=='form_movil'){
            include "modules/movil/form.php";
        }

        elseif($_GET['module']=='chofer'){
            include "modules/chofer/view.php";
        }
        elseif($_GET['module']=='form_chofer'){
            include "modules/chofer/form.php";
        }

        elseif($_GET['module']=='informes_compra'){
            include "modules/informes_compra/view.php";
        }

        elseif($_GET['module']=='informes_venta'){
            include "modules/informes_venta/view.php";
        }

        elseif($_GET['module']=='informes_pedido'){
            include "modules/informes_pedido/view.php";
        }

        elseif($_GET['module']=='informes_presupuesto'){
            include "modules/informes_presupuesto/view.php";
        }

        elseif($_GET['module']=='informes_orden'){
            include "modules/informes_orden/view.php";
        }

        elseif($_GET['module']=='informes_caja_apertura_cierre'){
            include "modules/informes_caja_apertura_cierre/view.php";
        }

        
        elseif($_GET['module']=='informes_nota_remision'){
            include "modules/informes_nota_remision/view.php";
        }
    }

?>
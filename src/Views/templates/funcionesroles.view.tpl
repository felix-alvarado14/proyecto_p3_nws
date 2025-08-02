<h1>Funciones para cada Rol</h1>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>ID Rol</th>
                <th>ID Funcion</th>
                <th>Estado</th>
                <th>Expira</th>

                <th>
                    <a href="index.php?page=Maintenance-Admin-Funciones-Funcion&mode=INS&id=" class="">New</a>
                </th>

            </tr>
        </thead>
        <tbody>
            {{foreach funcionesroles}}
            <tr>
                <td>{{rolescod}}</td>
                <td>{{fncod}}</td>
                <td>{{fnrolest}}</td>
                <td>{{fnexp}}</td>
                <td>
                    <a href="index.php?page=Maintenance-Admin-Funciones-Funcion&mode=UPD&fncod={{fncod}}" >
                        Editar
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Admin-Funciones-Funcion&mode=DSP&fncod={{fncod}}" >
                        Ver
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Admin-Funciones-Funcion&mode=DEL&fncod={{fncod}}" >
                        Eliminar
                    </a>
                </td>
            </tr>
            {{endfor funcionesroles}}
        </tbody>
    </table>



</section>  

<br>


<script>

                    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnRolesAsign")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Admin-RolUsuario-Rolusuario");
            });
    });
    
    </script>
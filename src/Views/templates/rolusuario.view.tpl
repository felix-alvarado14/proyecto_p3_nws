<h1>Roles para cada usuario</h1>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>ID Usuario</th>
                <th>ID Rol</th>
                <th>Estado</th>
                <th>Creación</th>
                <th>Expiración</th>

                <th>
                    <a href="index.php?page=Maintenance-Admin-Books-Book&mode=INS&id=" class="">New</a>
                </th>

            </tr>
        </thead>
        <tbody>
            {{foreach rolusuario}}
            <tr>
                <td>{{usercod}}</td>
                <td>{{rolescod}}</td>
                <td>{{roleuserest}}</td>
                <td>{{roleuserfch}}</td>
                <td>{{roleuserexp}}</td>
                <td>
                    <a href="index.php?page=Maintenance-Admin-Books-Book&mode=UPD&id_libro={{id_libro}}" >
                        Editar
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Admin-Books-Book&mode=DSP&id_libro={{id_libro}}" >
                        Ver
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Admin-Books-Book&mode=DEL&id_libro={{id_libro}}" >
                        Eliminar
                    </a>
                </td>
            </tr>
            {{endfor rolusuario}}
        </tbody>
    </table>



</section>  

<br>
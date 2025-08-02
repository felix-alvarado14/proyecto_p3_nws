<h1>Roles</h1>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Estado</th>

                <th>
                    <a href="index.php?page=Maintenance-Books-Book&mode=INS&id=" class="">New</a>
                </th>

            </tr>
        </thead>
        <tbody>
            {{foreach roles}}
            <tr>
                <td>{{rolescod}}</td>
                <td>{{rolesdsc}}</td>
                <td>{{rolesest}}</td>
                <td>
                    <a href="index.php?page=Maintenance-Books-Book&mode=UPD&id_libro={{id_libro}}" >
                        Editar
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Books-Book&mode=DSP&id_libro={{id_libro}}" >
                        Ver
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Books-Book&mode=DEL&id_libro={{id_libro}}" >
                        Eliminar
                    </a>
                </td>
            </tr>
            {{endfor roles}}
        </tbody>
    </table>
</section>
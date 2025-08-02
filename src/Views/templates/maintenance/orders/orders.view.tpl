<h1>Ordenes</h1>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>ID Orden</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
            {{foreach orders}}
            <tr>
                <td>{{id_orden}}</td>
                <td>{{id_usuario}}</td>
                <td>{{useremail}}</td>
                <td>
                    <a href="index.php?page=Maintenance-Admin-Ordnes-Order&mode=DSP&id_orden={{id_orden}}" >
                        Ver
                    </a> &nbsp;
                </td>
            </tr>
            {{endfor orders}}
        </tbody>
    </table>
</section>
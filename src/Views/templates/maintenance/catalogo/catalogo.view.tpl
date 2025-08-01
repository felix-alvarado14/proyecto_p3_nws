<h1>Books</h1>
<div>

    {{foreach books}}
        <div class="product" data-id_libro="{{id_libro}}">
            <h2>{{titulo}}</h2>
            <p>Autor: {{autor}}</p>
            <p>Genero: {{genero}}</p>
            <p>Año: {{publicacion_year}}</p>
            <p>Editorial: {{editora}}</p>
            <button class="add-to-cart">Agregar al carrito</button>
        </div>
    {{endfor books}}
</div>
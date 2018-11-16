{ "collection" :
    {
        "title" : "Series Database",
            "type" : "Serie",
            "version" : "1.0",
            "href" : "{{ path_for('series')}}",

            "links" : [
                {"rel" : "profile" , "href" : "http://schema.org/movie","prompt":"Perfil"},
                {"rel" : "collection", "href" : "{{ path_for('movies') }}","prompt":"Movies"},
                {"rel" : "collection", "href" : "{{ path_for('books') }}","prompt":"Books"},
                {"rel" : "collection", "href" : "{{ path_for('musicalbums') }}","prompt":"Music Albums"},
                {"rel" : "collection", "href" : "{{ path_for('games') }}","prompt":"Videogames"},
				    {"rel" : "collection", "href" : "{{ path_for('series') }}","prompt":"Series"}
            ],
      
            "items" : [
                {% for item in items %}
	  
                {
                    "href" : "{{ path_for('series') }}/{{ item.id }}",
                        "data" : [
                            {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre de la serie"}
                        ]
                        } {% if not loop.last %},{% endif %}
	  
                {% endfor %}
	  
            ],
      
            "template" : {
            "data" : [
                {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre de la serie"},
                {"name" : "description", "value" : "{{ item.description }}", "prompt" : "Descripción del Juego"},
                {"name" : "temporadas", "value" : "{{ item.temporadas }}", "prompt" : "Temporadas"},
                {"name" : "datePublished", "value" : "{{ item.datePublished }}", "prompt" : "Fecha de lanzamiento"},
                {"name" : "embedUrl", "value" : "{{ item.embedUrl }}", "prompt" : "Web"}        
            ]
                }
    } 
}





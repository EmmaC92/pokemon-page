<div>
    <h1>
        Moves
    </h1>
    {% for attack in attempt %}
        <strong>
            {{ attack['pokemon'] }}
            : 
            {{ attack['attack'] }}
            | 
            {{ attack['value'] }}
            .
            <br></strong>
        {% endfor %}
    </div>
    
<div class="block-container">
    {%FOR file IN files %}

    <div class="small block">
        <div class="pic-100">{% if file.is_pic %}
            <img src="{{ROOT}}{{file.urlpath}}" />
            {% else %}
            <i class="fa fa-picture-o" style="font-size: 5em"></i>
            {% endif %}
        </div>
        <div>
            {{file.name}}
        </div>
        <div>
            <a href="{{file.deleteurl}}" onclick="return(confirm('Are you sure to want to delete this file ?'));"><i class="fa fa-trash"></i></a>
        </div>

    </div>
    {% endfor %}
</div>
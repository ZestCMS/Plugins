<div class="full-overlay">
    <div class="block-container">
        {%FOR file IN files %}

        <div class="small block">
            <div>
                <a onclick="insertAtCaret('{{textareaid}}', '{{file.insert_code}}');
                        $.fancybox.close(all);
                        return false;" title="{{file.name}}">
                    {% if file.is_pic %}
                    <img src="{{ROOT}}{{file.urlpath}}" title="{{file.name}}" alt="{{file.name}}" />
                    {% else %}
                    <i class="fa fa-picture-o" style="font-size: 5em"></i>
                    {% endif %}
                </a>
            </div>
            <div>

            </div>

        </div>
        {% endfor %}
    </div>
</div>
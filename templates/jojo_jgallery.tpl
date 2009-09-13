{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("#jgallery-thumbnail li a").click(function(){
		$("#jgallery-large img").hide().attr({"src": $(this).attr("href"), "title": $("> img", this).attr("title"), "alt": $("> img", this).attr("title")});
		$("#jgallery-large a").attr({"href": "images/default/jgalleryimages/"+$("> img", this).attr("id") });
		$("#jgallery-caption p").html($("> img", this).attr("title"));
		return false;
	});
	$("#jgallery-large img").load(function(){$("#jgallery-large img:hidden").fadeIn("slow")});
});
</script>
{/literal}
    <h3>{$jgallery.title}</h3>
    <div id="jgallery-large">
        <img title="{$jgalleryimages[0].description}" src="images/w{$jgallery.jg_width}/jgalleryimages/{$jgalleryimages[0].filename}" alt="{$jgalleryimages[0].description}" />
    </div>
    <div id="jgallery-caption"><p class="caption">{$jgalleryimages[0].description}</p></div>
    <div id="jgallery-thumbnail-wrap">
        <ul id="jgallery-thumbnail" style="width:{$jgalleryimageswidth}px">
        {foreach from=$jgalleryimages key=k item=i}
            <li><a href="images/w{$jgallery.jg_width}/jgalleryimages/{$i.filename}"><img id="{$i.filename}" title="{$i.description}" src="images/70x50/jgalleryimages/{$i.filename}" alt="{$i.description}" /></a></li>
        {/foreach}
        </ul>
    </div>
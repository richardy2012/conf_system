var region =  new Object();
region.loadRegions = function(parent, type, target, select_id){
	$.getJSON('/index.php/region', {parent:parent, type:type, target:target},function(data){
		var sel = document.getElementById(data.target);
		sel.length = 1;
		sel.selectedIndex = 0;
		//sel.style.display = (result.regions.length == 0 && ! region.isAdmin && result.type + 0 == 3) ? "none" : '';
		for (i = 0; i<data.regions.length; i++){
		  var opt = document.createElement("OPTION");
		  opt.value = data.regions[i].region_id;
		  opt.text  = data.regions[i].region_name;
		  sel.options.add(opt);
		}
		if(select_id)
			sel.value = select_id;
	});
}

region.changed = function(obj, type, selName, select_id){
  var parent = obj.value;
  region.loadRegions(parent, type, selName, select_id);
}

region.clear = function(selName){
	document.getElementById(selName).length = 1;
}
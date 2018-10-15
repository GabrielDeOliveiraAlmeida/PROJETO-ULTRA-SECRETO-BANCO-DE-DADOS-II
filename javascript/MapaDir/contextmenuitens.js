//	create the ContextMenuOptions object
var contextMenuOptions={};
contextMenuOptions.classNames={menu:'context_menu', menuSeparator:'context_menu_separator'};

//	create an array of ContextMenuItem objects
var menuItems=[];
menuItems.push({className:'context_menu_item', eventName:'excluir_click', label:'Excluir'});
menuItems.push({className:'context_menu_item', eventName:'horario_click', label:'Alterar Horário'});
menuItems.push({className:'context_menu_item', eventName: 'color_click', label: 'Alterar Cor'});
//	a menuItem with no properties will be rendered as a separator
menuItems.push({});
menuItems.push({className:'context_menu_item', eventName:'center_map_click', label:'Centrar Mapa aqui'});

contextMenuOptions.menuItems=menuItems;
//	create the ContextMenu object
var contextMenu = new ContextMenu(map, contextMenuOptions);



// var contextMenuMarker={};
// contextMenuMarker.classNames={menu:'context_menu', menuSeparator:'context_menu_separator'};
// var menuItemMarker=[];
// menuItemMarker.push({className:'context_menu_item', eventName:'excluir_marker_click', label:'Excluir'});
// contextMenuMarker.menuItems=menuItemMarker;
//
// var contextMenuMarkerMap = new ContextMenu(map, contextMenuMarker);
if (window.innerWidth > 1024) {
    $(function(){
      $(".imgZoom").jqZoom({
        selectorWidth: 30,
        selectorHeight: 30,
        viewerWidth: 400,
        viewerHeight: 300,
        zoomLevel: 2,
      });
    });

}
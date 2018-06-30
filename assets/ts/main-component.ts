declare var aristonet_projects_php_vars : any;
declare var Nanobar: any;
class MainComponent {
    routeList:string;
    routeSingle:string;
    static Container:HTMLElement;
    constructor(private locationPath : string) {
        this.prepareRoutes();
        let nanobar = new Nanobar({target: document.querySelector('body')});
        if(this.routeSingle){
             new DetailComponent(this.routeSingle, nanobar)
        }else{
             new ListComponent(this.routeList,  nanobar)
        }
    }
    prepareRoutes(){
        let restUrl : string = aristonet_projects_php_vars.rest_url; // http://localhost/restapi/wp-json
        let slug : string = aristonet_projects_php_vars.shortcode_location; // proiecte
        this.routeList =  `${restUrl}wp/v2/project/`; 
        var matchArray = this.locationPath
            .substring(0, this.locationPath.length - 1)
            .match(/.*\/(.*)$/);
        var lastSlug = matchArray[1];
        if (slug !== lastSlug){
            this.routeSingle = `${restUrl}wp/v2/project/?slug=${lastSlug}`;
        }else{
            this.routeSingle = null;
        }
    }
}
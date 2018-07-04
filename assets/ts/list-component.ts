class ListComponent
{
    templatePath:string;
    

    totalObjects:number = 0;
    totalPages:number = 0;
    constructor(private route:string, private nanobar:any){
        this.templatePath = aristonet_projects_php_vars.templatesUrl + '/' + aristonet_projects_php_vars.templateName;
        this.render();
    }

   

    getProjects(){
        let _this = this;
        function status(response) {
            if (response.status >= 200 && response.status < 300) {
            return Promise.resolve(response)
            } else {
            return Promise.reject(new Error(response.statusText))
            }
        }
      
        function json(response) {
           
            
           _this.totalObjects =  response.headers.get('X-WP-Total');
           _this.totalPages = response.headers.get('X-WP-TotalPages');
            
            
            
            
            return response.json()
        }
        return fetch(this.route).then(status).then(json);
           
            
    }
    render(){
        let _this = this;

        this.nanobar.go(30);
        this.getProjects().then( projects =>{
            
            fetch(this.templatePath)
            .then(response => response.text())
            .then(template => {
               MainComponent.Container.innerHTML = Mustache.render(template, {ProjectList:projects });
               this.addEventHandlers();
               new PaginationComponent(_this.totalObjects,_this.totalPages);
               this.nanobar.go(100);
            });
            
           
           
        }).catch(function(error) {
            console.log('Request failed', error);
         });
    }
    addEventHandlers(){
        let links = MainComponent.Container.querySelectorAll('a');
         for (const link of links) {
            link.addEventListener('click', (e)=>{
                e.preventDefault();
                history.pushState('','', (<HTMLLinkElement>e.target).href);
                new MainComponent(location.pathname);
            });
         }
    }
}

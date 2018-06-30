class ListComponent
{
    templatePath:string;
    constructor(private route:string, private nanobar:any){
        this.templatePath = aristonet_projects_php_vars.templatesUrl + '/' + aristonet_projects_php_vars.templateName;
        console.log(this.templatePath );
        this.render();
    }
    getProjects(){
       return fetch(this.route).then(response => {
            return response.json();
        }); 
    }
    render(){
        this.nanobar.go(30);
        this.getProjects().then( projects =>{
            let output = '' ;
            fetch(this.templatePath)
            .then(response => response.text())
            .then(template => {
               output = Mustache.render(template, {ProjectList:projects });
               MainComponent.Container.innerHTML = output;
            });   
            this.nanobar.go(100);
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

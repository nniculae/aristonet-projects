class DetailComponent {
    templatePath:string;
    constructor(private route : string, private nanobar : any) {
        this.templatePath = aristonet_projects_php_vars.templatesUrl + '/' + aristonet_projects_php_vars.singleProjectTemplateName;
        this.render();
    }
    getProject() {
        return fetch(this.route).then(response => {
            return response.json();
        });
    }
    render() {
        this.nanobar.go(30);
        this
            .getProject()
            .then(projects => {
               console.log(projects);
              let project = projects[0]  ;
              this.nanobar.go(60);
                    let output = '' ;
                    fetch(this.templatePath)
                        .then(response => response.text())
                        .then(template => {
                            output = Mustache.render(template, project);
                            MainComponent.Container.innerHTML = output;
                      });   
                  this.nanobar.go(100);
            });
    }
}


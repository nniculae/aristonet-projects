class DetailComponent {
    constructor(route, nanobar) {
        this.route = route;
        this.nanobar = nanobar;
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
            let project = projects[0];
            this.nanobar.go(60);
            let output = '';
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
class ListComponent {
    constructor(route, nanobar) {
        this.route = route;
        this.nanobar = nanobar;
        this.templatePath = aristonet_projects_php_vars.templatesUrl + '/' + aristonet_projects_php_vars.templateName;
        console.log(this.templatePath);
        this.render();
    }
    getProjects() {
        return fetch(this.route).then(response => {
            return response.json();
        });
    }
    render() {
        this.nanobar.go(30);
        this.getProjects().then(projects => {
            let output = '';
            fetch(this.templatePath)
                .then(response => response.text())
                .then(template => {
                output = Mustache.render(template, { ProjectList: projects });
                MainComponent.Container.innerHTML = output;
            });
            this.nanobar.go(100);
        });
    }
    addEventHandlers() {
        let links = MainComponent.Container.querySelectorAll('a');
        for (const link of links) {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                history.pushState('', '', e.target.href);
                new MainComponent(location.pathname);
            });
        }
    }
}
class MainComponent {
    constructor(locationPath) {
        this.locationPath = locationPath;
        this.prepareRoutes();
        let nanobar = new Nanobar({ target: document.querySelector('body') });
        if (this.routeSingle) {
            new DetailComponent(this.routeSingle, nanobar);
        }
        else {
            new ListComponent(this.routeList, nanobar);
        }
    }
    prepareRoutes() {
        let restUrl = aristonet_projects_php_vars.rest_url; // http://localhost/restapi/wp-json
        let slug = aristonet_projects_php_vars.shortcode_location; // proiecte
        this.routeList = `${restUrl}wp/v2/project/`;
        var matchArray = this.locationPath
            .substring(0, this.locationPath.length - 1)
            .match(/.*\/(.*)$/);
        var lastSlug = matchArray[1];
        if (slug !== lastSlug) {
            this.routeSingle = `${restUrl}wp/v2/project/?slug=${lastSlug}`;
        }
        else {
            this.routeSingle = null;
        }
    }
}
class Startup {
    static main() {
        MainComponent.Container = document.querySelector('#aristonet-projects');
        new MainComponent(location.pathname);
        //fetchInsert(location.pathname);
        window.addEventListener('popstate', e => {
            new MainComponent(location.pathname);
        });
        return 0;
    }
}
window.onload = function () {
    Startup.main();
};
//# sourceMappingURL=projects.js.map
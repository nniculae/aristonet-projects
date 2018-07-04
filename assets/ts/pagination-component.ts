// https://www.youtube.com/watch?v=E3kol40-ax8
class PaginationComponent {

    /**
     * specify the page of results to return
     * For example, /wp/v2/posts?page=2 is the second page of posts results
     */
    page : number;
    /**
     * specify the number of records  to return in one request, specified as an integer from 1 to 100.
     * For example, /wp/v2/posts?per_page=1 will return only the first post in the collection
     */
    per_page : number;
    /**
     *   specify an arbitrary offset at which to start retrieving posts
     *   For example, /wp/v2/posts?offset=6 will use the default number of posts per page, but start at the 6th post in the collection
     *   ?per_page=5&page=4 is equivalent to ?per_page=5&offset=15
     */
    offset : number;
    /**
    * X-WP-Total: the total number of records in the collection
    */
    totalObjects : number;
    /**
    * X-WP-TotalPages: the total number of pages encompassing all available records
    *  By inspecting these header fields you can determine how much more data is available within the API.
    */
    totalPages : number;

    currentPage: number = 1;
    previousPage: number;
    nextPage:number;

    constructor(totalObjects, totalPages) {
        this.totalObjects = totalObjects;
        this.totalPages = totalPages;
        // this.totalObjects = response
        //     .headers
        //     .get('X-WP-Total');
        // this.totalPages = response
        //     .headers
        //     .get('X-WP-TotalPages');

        this.render();
    }
    render() {
        const locationPathname = location.pathname;

        if(locationPathname.indexOf('page') === -1){
            this.currentPage = 1;
            console.log("Current page: %s: ",this.currentPage );
        }else{ // page/2
            
            let pageNumberIndex = locationPathname.substring(0,locationPathname.length -1).lastIndexOf('/') + 1;
            this.currentPage = parseInt(locationPathname.substring(pageNumberIndex));
            console.log("Current page: %s: ",this.currentPage );
            
        }

        this.nextPage = this.currentPage + 1; 
        if(this.currentPage > 1)  {
            this.previousPage = this.currentPage -1;
        }
        // else{
        //     this.currentPage = 0;
        // }
        if(this.currentPage === this.totalPages) {
            this.nextPage = null;
        }else{
            this.nextPage = this.currentPage + 1;
        }

        let href  = `http://localhost/restapi/projects/page/${this.nextPage}/`
      
        let html = '';
        html += `<div id="pagination">`;
        html += `<h1>Page ${this.currentPage} of ${this.totalPages} </h1>`;
        html += `<a  href="${href}" id="next-page">Next Page</a>`;
        html += `</div>`;


        MainComponent.Container.insertAdjacentHTML('beforeend', html);
       
        this.addEventHandlers();

    }
    addEventHandlers(){
        window.scroll({
            top: 0,
            behavior: "smooth"
          });

        let nextPage = document.querySelector('#next-page');
        nextPage.addEventListener('click', (e)=>{
            e.preventDefault();
            history.pushState('','', (<HTMLLinkElement>e.target).href);
            let nanobar = new Nanobar({target: document.querySelector('body')});
            new MainComponent(location.pathname);
           
        });

         
    }
   

}


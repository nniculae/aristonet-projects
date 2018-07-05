// see https://connekthq.com/plugins/ajax-load-more/extensions/rest-api/
class Startup {
    public static main(): number {
        MainComponent.Container = document.querySelector('#aristonet-projects');
        new MainComponent(location.pathname);
        window.addEventListener('popstate', e=>{
            new MainComponent(location.pathname);
        });
        return 0;
    }
}
window.onload = function(){
    Startup.main();
};

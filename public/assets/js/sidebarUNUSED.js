<script>
    
        const sidebarToggle = document.getElementById("sidebar-toggle");


        function toggleSidebar() {
            document.getElementById("sidebar-logo").classList.toggle("hidden");
            document.getElementById("sidebar-toggle").classList.toggle("mx-auto");
            
            // For each paragraph element in the nav, toggle the hidden class
            document.querySelectorAll("nav p").forEach((p) => {
                p.classList.toggle("hidden");
                p.parentElement.classList.toggle("justify-center");
            });
            
            document.getElementById("sidebar").classList.toggle("w-56");
            document.getElementById("sidebar").classList.toggle("w-20");
            

        }

        sidebarToggle.addEventListener("click" , () =>{
            toggleSidebar();
            if (localStorage.getItem("sidebar") === "collapsed") {
                localStorage.setItem("sidebar", "expanded");
            } else {
                localStorage.setItem("sidebar", "collapsed");
            }
        });

        // On page load, check if the sidebar is collapsed
        document.addEventListener("DOMContentLoaded", () => {
            if (localStorage.getItem("sidebar") === "collapsed") {
                toggleSidebar();
            }
        });


        


    </script>
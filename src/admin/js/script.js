/**
 * Admin.
 */

const lbdLoad = () => {
    // All the navigation tabs.
    const lbdTabs = document.querySelectorAll( '.lbd-admin-header .nav .tab' );
    

    /**
     * Updates the DOM elements and switches to a specified navigation tab.
     * 
     * @param {HTMLElement} tab 
     */
    const lbdSwitchToTab = ( tab ) => {
        const lbdActiveTab = document.querySelector( '.lbd-admin-header .nav .tab.active' );
        const lbdActiveTabContent = document.querySelector( '.tab-content .tab-pane.active' );
        const lbdTabContent = document.querySelector( tab.getAttribute( 'href' ) );
        
        lbdActiveTab.classList.remove( 'active' );
        lbdActiveTabContent.classList.remove( 'active' );

        tab.classList.add( 'active' );
        lbdTabContent.classList.add( 'active' );
    };

    /**
     * Triggers the tab switcher when an inactive tab is clicked.
     * 
     * @param {Object} event 
     */
    const lbdSwitchTab = ( event ) => {
        event.preventDefault();

        const tab = event.target;
        
        if ( ! tab.classList.contains( 'active' ) ) {
            lbdSwitchToTab( tab );
        }
    }

    /**
     * Switch to each tab when it is clicked.
     */
    lbdTabs.forEach(
        lbdTab => {
            lbdTab.addEventListener( 'click', lbdSwitchTab, false );
        }
    );
    
    console.log( 'LBD Plugin Running...' );
};

// Runs the container function when the DOM is loaded.
document.addEventListener( 'DOMContentLoaded', lbdLoad );
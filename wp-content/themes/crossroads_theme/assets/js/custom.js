document.querySelectorAll('.services-nav .nav-link[data-toggle="collapse"]').forEach(link=>{
link.addEventListener('click',function(e){
    e.preventDefault();
    const targetId=this.getAttribute('data-target')||this.getAttribute('href'),
        target=document.querySelector(targetId),
        arrowIcon=this.querySelector('.rotate-icon');
    if(!target)return;
    const isOpen=target.classList.contains('show');
    document.querySelectorAll('.services-nav .collapse').forEach(div=>div.classList.remove('show'));
    document.querySelectorAll('.services-nav .nav-link[aria-expanded]').forEach(l=>{
    l.setAttribute('aria-expanded','false');
    const icon=l.querySelector('.rotate-icon');
    if(icon)icon.classList.remove('rotated');
    });
    if(!isOpen){
    target.classList.add('show');
    this.setAttribute('aria-expanded','true');
    if(arrowIcon)arrowIcon.classList.add('rotated');
    }
});
});
// Open submenu of active page on load
document.addEventListener('DOMContentLoaded',()=>{
const url=window.location.href;
document.querySelectorAll('.services-nav .collapse .nav-link').forEach(link=>{
    if(url.includes(link.getAttribute('href'))){
    const collapseDiv=link.closest('.collapse');
    if(collapseDiv){
        collapseDiv.classList.add('show');
        const toggle=document.querySelector(`[data-target="#${collapseDiv.id}"]`);
        if(toggle){
        toggle.setAttribute('aria-expanded','true');
        toggle.classList.add('active');
        const icon=toggle.querySelector('.rotate-icon');
        if(icon)icon.classList.add('rotated');
        }
    }
    }
});
});

document.addEventListener('DOMContentLoaded', () => {
  const path = window.location.pathname.replace(/\/+$/, '').toLowerCase();
  
  // Loop through all menu groups
  document.querySelectorAll('.services-nav .nav-item').forEach(item => {
    const parentLink = item.querySelector('.parent-category');
    const submenu = item.querySelector('.collapse');
    const childLinks = submenu ? submenu.querySelectorAll('.nav-link') : [];

    // Get parent toggle href (should be an anchor like #submenu1)
    const toggleTarget = parentLink ? parentLink.getAttribute('href') : null;

    let isChildActive = false;

    // Check child links for a match
    childLinks.forEach(link => {
      const href = link.getAttribute('href');
      if (!href) return;

      const testPath = new URL(href, window.location.origin).pathname.replace(/\/+$/, '').toLowerCase();

      if (testPath === path) {
        link.classList.add('active');
        isChildActive = true;
      }
    });

    if (isChildActive) {
      // Child page matched: expand parent and mark parent active
      if (submenu) submenu.classList.add('show');
      if (parentLink) {
        parentLink.classList.add('active-parent');
        parentLink.setAttribute('aria-expanded', 'true');

        const icon = parentLink.querySelector('.rotate-icon');
        if (icon) icon.classList.add('rotated');
      }
    } else if (toggleTarget && toggleTarget.startsWith('#')) {
      // If current page is the parent category itself, highlight parent only
      const targetID = toggleTarget.slice(1);
      const termLink = document.querySelector(`.services-nav .nav-link[href="#${targetID}"]`);

      if (termLink) {
        const termURL = new URL(window.location.origin + '/' + targetID.replace('submenu', '') + '/').pathname.replace(/\/+$/, '').toLowerCase();
        
        if (path.includes(termURL) && !isChildActive) {
          parentLink.classList.add('active-parent');
          parentLink.setAttribute('aria-expanded', 'false'); // Keep submenu collapsed
        }
      }
    }
  });

  // Standalone services (bottom links)
  document.querySelectorAll('.services-nav > .nav-item > .nav-link:not(.parent-category)').forEach(link => {
    const href = link.getAttribute('href');
    if (!href) return;

    const testPath = new URL(href, window.location.origin).pathname.replace(/\/+$/, '').toLowerCase();

    if (testPath === path) {
      link.classList.add('active');
    }
  });
});

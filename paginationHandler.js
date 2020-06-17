/*
    ---------------------------------------------------
    Pagination Handler - Developed By: Rafael Tessarolo
    ---------------------------------------------------
*/
window.onload = () => {
    const pagination = document.querySelector('.pagination');
    const pageLink = document.querySelectorAll('.page-link');

    const pageName = document.getElementById('page-name').value;
	const numberOfPages = document.getElementById('number-of-pages').value;
    const currentPage = document.getElementById('current-page').value;
    const site_url_php = document.getElementById('site-url-php').value;

    const site_url = `${site_url_php}${pageName}`;

    pagination.style.display = 'flex';
    pagination.style.justifyContent = 'center';

    pageLink.forEach(link => {

        initializeLink(link, currentPage);

        link.onmouseover = () => {
            link.style.color = 'black';
            link.style.backgroundColor = 'white';
        }

        link.onmouseout = () => {
            initializeLink(link, currentPage);
        }
    });
 
    console.log("Previous Page:", getPreviousPage());
    console.log("Current Page:", getCurrentPage());
    console.log("Next Page:", getNextPage(numberOfPages));

    document.getElementById('previousPage').href = `?page=${getPreviousPage()}`;
    document.getElementById('nextPage').href = `?page=${getNextPage(numberOfPages)}`;
}


function hideElementById(id, value) {
    if (value) {
        document.getElementById(id).style.display = 'none';
    } else {
        document.getElementById(id).style.display = 'block';
    }
}

function initializeLink(link, currentPage) {
    if (link.innerHTML == currentPage) {
        link.style.color = 'white';
        link.style.backgroundColor = 'gray';
    } else {
        link.style.color = 'blue';
        link.style.backgroundColor = 'white';
    }
}

function getCurrentPage() {
    const url = window.location.href;
	let params = (new URL(url)).searchParams;
	if (params.get('page')) {
		return params.get('page');
	} else {
		return 1;
	}
}

function getPreviousPage() {
    if (getCurrentPage() == 1) {
		hideElementById('previousPage', true);
        return 1;
    } else {
		hideElementById('previousPage', false);
        return parseInt(getCurrentPage()) - 1;
    }
}

function getNextPage(numberOfPages) {
	if (getCurrentPage() == numberOfPages) {
		hideElementById('nextPage', true);
        return numberOfPages;
    } else {
		hideElementById('nextPage', false);
        return parseInt(getCurrentPage()) + 1;
    }
}
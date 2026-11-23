const organizationSearch = document.getElementById('organizationSearch');
organizationSearch.addEventListener('keyup', event => handleOrganizationSearchChange(event.target.value));
organizationSearch.addEventListener('blur', () => handleOrganizationSearchBlur());
organizationSearch.addEventListener('search', event => handleOrganizationOnSearch(event));

document.getElementById('userEmail').addEventListener('keyup', () => validateForm());
document.getElementById('arkadeVersion').addEventListener('change', () => handleArkadeVersionSelect());

document.getElementById('downloadDialogCancel').addEventListener('click', () => hideDownloadDialog());
document.getElementById('downloadDialogSubmit').addEventListener('click', () => handleDownloadDialogSubmit());

document.querySelectorAll('[data-application-type]').forEach(button => {
  button.addEventListener('click', () => showDownloadDialog(button.dataset.applicationType));
});

document.querySelectorAll('[data-expand-target]').forEach(toggle => {
  toggle.addEventListener('click', () => toggleExpand(toggle.dataset.expandTarget, toggle));
});

document.getElementById('mapPreview').addEventListener('click', () => showMapModal());
document.getElementById('mapModalClose').addEventListener('click', () => hideMapModal());

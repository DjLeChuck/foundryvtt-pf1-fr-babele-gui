import { Controller } from '@hotwired/stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static targets = ['hiddenRow'];
  static values = {
    open: String,
    close: String,
  };

  toggle(e) {
    e.preventDefault();

    const target = e.currentTarget;

    this.hiddenRowTargets.forEach(row => {
      if (row.dataset.term !== target.dataset.term) {
        return;
      }

      row.classList.toggle('d-none');

      if (row.classList.contains('d-none')) {
        target.querySelector('img').src = this.openValue;
      } else {
        target.querySelector('img').src = this.closeValue;
      }
    });
  }
}

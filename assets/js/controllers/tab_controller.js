import { Controller } from '@hotwired/stimulus';
import { Tab } from 'bootstrap';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static targets = ['trigger'];

  connect() {
    this.triggerTargets.forEach(triggerEl => {
      const tabTrigger = new Tab(triggerEl);

      triggerEl.addEventListener('click', event => {
        event.preventDefault();

        tabTrigger.show();
      });
    });
  }
}

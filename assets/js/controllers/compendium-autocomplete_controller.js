import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  clearSelection() {
    this.element.tomselect.clear();
  }
}

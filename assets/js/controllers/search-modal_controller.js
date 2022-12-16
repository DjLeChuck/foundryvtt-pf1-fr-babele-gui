import { Controller } from '@hotwired/stimulus';
import { useDispatch } from 'stimulus-use';
import { Modal } from 'bootstrap';

export default class extends Controller {
  static targets = ['term'];

  connect() {
    useDispatch(this);

    this.modal = new Modal(this.element);
  }

  open() {
    if (!this.modal) {
      return;
    }

    this.modal.show();
  }

  close() {
    if (!this.modal) {
      return;
    }

    this.modal.hide();
  }

  sendResult(e) {
    e.preventDefault();

    if (!this.hasTermTarget || !this.termTarget.value) {
      return;
    }

    this.dispatch('result', { value: this.termTarget.value });
    this.close();
  }
}

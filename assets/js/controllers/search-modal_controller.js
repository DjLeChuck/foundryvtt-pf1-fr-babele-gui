import { Controller } from '@hotwired/stimulus';
import { useDispatch } from 'stimulus-use';
import { Modal } from 'bootstrap';

export default class extends Controller {
  static targets = ['term'];

  connect() {
    useDispatch(this);

    this.modal = new Modal(this.element);
    this.element.addEventListener('hide.bs.modal', () => this.hasTermTarget && this.termTarget.tomselect.clear())
  }

  open(e) {
    if (!this.modal) {
      return;
    }

    this.modal.show();

    if (this.hasTermTarget) {
      const text = e?.detail?.text;
      if (text) {
        this.termTarget.tomselect.load(text.replace(/s$/, ''));
      }

      this.termTarget.tomselect.focus();
    }
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

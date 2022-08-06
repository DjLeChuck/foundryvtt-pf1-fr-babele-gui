import { Controller } from '@hotwired/stimulus';
import { useDispatch } from 'stimulus-use';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static targets = ['input', 'output', 'spinner', 'img'];
  static values = {
    url: String,
  };

  connect() {
    useDispatch(this);
  }

  async do(e) {
    e.preventDefault();

    const btn = e.currentTarget;
    this.spinnerTarget.classList.remove('visually-hidden');
    this.imgTarget.classList.add('visually-hidden');
    btn.disabled = true;

    try {
      const body = new FormData();
      body.append('text', this.inputTarget.innerText);

      const response = await (await fetch(this.urlValue, {
        method: 'POST',
        body,
      })).json();

      this.outputTarget.innerText = response.text;

      this.dispatch('translated');
    } catch (err) {
      console.error(err);
    } finally {
      this.spinnerTarget.classList.add('visually-hidden');
      this.imgTarget.classList.remove('visually-hidden');
      btn.disabled = false;
    }
  }
}

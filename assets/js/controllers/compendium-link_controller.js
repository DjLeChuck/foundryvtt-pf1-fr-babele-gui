import { Controller } from '@hotwired/stimulus';
import { useDispatch } from 'stimulus-use';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  connect() {
    useDispatch(this);
  }

  search({ detail: { model } }) {
    model.change(() => {
      const range = model.document.selection.getFirstRange();
      let textAttributes = {};
      let text = '';

      for (const item of range.getItems()) {
        if (item.is('$text') || item.is('$textProxy')) {
          text = item.data;
          textAttributes = item.getAttributes();
          break;
        }
      }

      if (text.length) {
        this.dispatch('search');
      }
    });
  }
}

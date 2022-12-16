import { Controller } from '@hotwired/stimulus';
import { useDispatch, useIntersection } from 'stimulus-use';
import BalloonEditor from '../../vendor/ckeditor/ckeditor';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static targets = ['editor', 'content'];

  isInit = false;

  connect() {
    useIntersection(this);
    useDispatch(this);
  }

  appear() {
    if (!this.isInit) {
      this.isInit = true;

      BalloonEditor
        .create(this.editorTarget, {
          initialData: this.contentTarget.innerText,
        })
        .then(editor => {
          this.editor = editor;

          editor.model.document.on('change:data', () => {
            this.contentTarget.innerText = editor.getData();
          });

          editor.keystrokes.set('Ctrl+space', () => this.dispatch('search', {
            model: editor.model,
          }));
        })
        .catch(error => {
          console.error(error);
        });
    }
  }

  update() {
    if (!this.editor) {
      return;
    }

    this.editor.setData(this.contentTarget.innerText);
  }

  addCompendiumLink(e) {
    if (!this.editor) {
      return;
    }

    const model = this.editor.model;

    model.change(writer => {
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
        model.insertContent(writer.createText(e.detail.value.replace('__label__', text), textAttributes), range);
      }
    });
  }
}

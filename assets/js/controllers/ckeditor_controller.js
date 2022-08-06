import { Controller } from '@hotwired/stimulus';
import { useIntersection } from 'stimulus-use';
import BalloonEditor from '../../vendor/ckeditor/ckeditor';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static targets = ['editor', 'content'];

  isInit = false;

  connect() {
    useIntersection(this);
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
}

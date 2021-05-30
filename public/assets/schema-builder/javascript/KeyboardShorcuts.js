
class KeyboardShortcuts
{
  _actionManager;

  constructor(actionManager) {

    this._actionManager = actionManager;


    window.addEventListener("keyup", (event) => {


      if(event.key == 's' && event.ctrlKey) {
        this._actionManager.saveSchema();
      }



    })
  }
}
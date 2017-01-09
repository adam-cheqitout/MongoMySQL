function collection(collectionName) {
  this.name = collectionName;
  this.find = (restraints, sort, callback) => {
    ajax_request(this.name, "post", restraints, sort, (res) => {
      if(res == "error"){
        console.warn("Error");
      } else {
        callback(JSON.parse(res));
      }
    });
  };
}

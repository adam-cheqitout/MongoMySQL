const post_component = (post) => {
  var html = `<div class='post'><h1>${post.id}</h1><p>${post.post}</p></div>`;
  return html;
};

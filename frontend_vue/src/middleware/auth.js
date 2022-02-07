export default function auth({ next }) {
  if (localStorage.getItem("user-token")) {
    next();
  } else {
    next("/login");
  }
}

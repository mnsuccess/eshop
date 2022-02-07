export default function guest({ next }) {
  if (localStorage.getItem("user-token")) {
    next({ name: "Products" });
  } else {
    next();
  }
}

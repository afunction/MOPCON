export default function ({ route, redirect, env }) {
  const routeMap = Object.entries(env).filter(([key, value]) => key.includes('route'))
  const name = route.name || route.path.replace(/\//g, '')

  const valid = routeMap.every(([key, value]) => key.endsWith(name) ? value : true)
  if (!valid) {
    redirect('/')
  }
}

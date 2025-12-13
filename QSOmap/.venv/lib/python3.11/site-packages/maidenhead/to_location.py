from __future__ import annotations
import functools


def to_location_rect(maiden: str) -> tuple[tuple[float, float], tuple[float, float], tuple[float, float]]:
    maiden = maiden.strip().upper()
    N = len(maiden)
    if N < 2 or N % 2:
        raise ValueError("Maidenhead locator requires even number of characters")

    precision = N//2

    def cvt(x: str) -> int: return ord(x) - ord('A')

    cvts = [cvt if not (i % 2) else lambda x: int(x) for i in range(precision)]
    weights = [24 if i % 2 else 10 for i in range(precision - 1)] + [1]

    def convert(maiden: str) -> tuple[int, int]:
        val = [c(v) for c, v in zip(cvts, maiden)]
        if any(0 > v >= 24 for v in val):
            raise ValueError("Locator uses A through X characters")
        if val[0] >= 18:
            raise ValueError("Locator uses A through R characters for the first pair")
        return functools.reduce(lambda ac, v: ((ac[0]+v[0])*v[1], ac[1]*v[1]), list(zip(val, weights)), (0, 1))

    lat_nom, lat_den = convert(maiden[1::2])
    lon_nom, lon_den = convert(maiden[::2])

    center_offset_lat = 5
    center_offset_lon = 10

    lat_1 = (10 * (lat_nom - 9 * lat_den)) / lat_den
    lon_1 = (20 * (lon_nom - 9 * lon_den)) / lon_den
    lat_c = (10 * (lat_nom - 9 * lat_den) + center_offset_lat) / lat_den
    lon_c = (20 * (lon_nom - 9 * lon_den) + center_offset_lon) / lon_den
    lat_2 = (10 * (lat_nom - 9 * lat_den) + 2*center_offset_lat) / lat_den
    lon_2 = (20 * (lon_nom - 9 * lon_den) + 2*center_offset_lon) / lon_den
    return ((lat_1, lon_1), (lat_2, lon_2), (lat_c, lon_c))


def to_location(maiden: str, center: bool = False) -> tuple[float, float]:
    """
    convert Maidenhead grid to latitude, longitude

    Parameters
    ----------

    maiden : str
        Maidenhead grid locator

    center : bool
        If true, return the center of provided maidenhead grid square, instead of default south-west corner
        Default value = False needed to maidenhead full backward compatibility of this module.

    Returns
    -------

    latLon : tuple of float
        Geographic latitude, longitude
    """
    bottomleft_point, (_, _), center_point = to_location_rect(maiden)

    return center_point if center else bottomleft_point


def to_geoJSONObject(maiden: str, center: bool = True, square: bool = True) -> dict:
    """
    convert Maidenhead grid to geoJSON object as dictionary, ready to be serialized into JSON string

    Parameters
    ----------

    maiden : str
        Maidenhead grid locator

    center : bool
        If true, add Point feature for the center of provided maidenhead grid square

    square : bool
        If true, add Polygon feature for the rectangle of provided maidenhead grid square

    Returns
    -------

    geo : geoJSON dict object. use json module to serialize it to string
    """
    loc1, loc2, locc = to_location_rect(maiden)
    center_point = {
        "type": "Feature",
        "properties": {"QTHLocator_Centerpoint": maiden},
        "geometry": {
            "type": "Point",
            "coordinates": [locc[1], locc[0]]
        }
    }

    rect = {
        "type": "Feature",
        "properties": {"QTHLocator": maiden},
        "geometry": {
            "type": "Polygon",
            "coordinates": [[(loc1[1], loc1[0]), (loc2[1], loc1[0]), (loc2[1], loc2[0]), (loc1[1], loc2[0]), (loc1[1], loc1[0])]]
        }
    }

    features: list = []
    geo = {
        "type": "FeatureCollection",
        "features": features
    }
    if center:
        features.append(center_point)
    if square:
        features.append(rect)
    # geo["features"] = features
    return geo
